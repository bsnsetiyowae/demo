<?php

namespace App\Support;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Page
{
    protected $locale;

    protected $page;

    protected $type;

    protected $disk;

    public function __construct(string $locale, string $type, ?string $page = null)
    {
        $this->locale = $locale;

        $this->type = $type;
        $this->page = $page;

        $this->disk = Storage::disk('content');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */

    public function view(string $view)
    {
        $path = "$this->locale/$this->type/$this->page.md";

        abort_if(!$this->disk->exists($path), 404);

        if (App::environment('production')) {
            $cachedData = Cache::rememberForever('view.' . md5($path), function () use ($path, $brand) {
                $markdown = Markdown::convert($this->disk->get($path));
                return $this->getViewData($path);
            });
        } else {
            $cachedData = $this->getViewData($path);
        }

        return view($view, $cachedData);
    }

    public function getSidebar()
    {
        return Markdown::convert($this->disk->get("$this->locale/docs/documentation.md"));
    }

    public function getViewData($path)
    {
        $markdown = Markdown::convert($this->disk->get($path));
        $brand = ucwords(config('site.name'));
        $apiUrl = config('site.{api_url}');

        $content = $markdown->getContent();
        $frontmatter = method_exists($markdown, 'getFrontMatter') ? $markdown->getFrontMatter() : [];

        if (isset($frontmatter['title'])) {
            $frontmatter['title'] = preg_replace('/{brand}/i', $brand, $frontmatter['title']);
        }

        if (isset($frontmatter['description'])) {
            $frontmatter['description'] = preg_replace('/{brand}/i', $brand, $frontmatter['description']);
        }

        $content = preg_replace('/{{api_url}}/i', $apiUrl, $content);
        $content = preg_replace('/{brand}/i', $brand, $content);

        return [
            'content' => $content,
            'frontmatter' => $frontmatter,
            'index' => $this->getSidebar(),
            'brand' => $brand,
        ];
    }

    public function getArticlesData($data)
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);

        $dom->loadHTML($data['content']);

        $xpath = new \DOMXPath($dom);

        $headings = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');

        $articleData = [];

        foreach ($headings as $heading) {
            $headingText = preg_replace('/{brand}/', $data['brand'], preg_replace('/\s+/', ' ', $heading->textContent));

            $nextSibling = $heading->nextSibling;
            while ($nextSibling && $nextSibling->nodeName !== 'p') {
                $nextSibling = $nextSibling->nextSibling;
            }

            $paragraphText = $nextSibling ? trim($nextSibling->textContent) : null;
            $paragraphText = preg_replace('/{brand}/', $data['brand'], preg_replace('/\s+/', ' ', $paragraphText));

            $anchor = $xpath->query('.//a', $heading)->item(0);
            $linkHref = $anchor ? config('app.url') . "/$this->type/$this->page" . $anchor->getAttribute('href') : null;

            if ($headingText && $paragraphText) {
                $articleData[] = [
                    'heading' => $headingText,
                    "lang" => $this->locale,
                    'href' => $linkHref,
                    'paragraph' => $paragraphText,
                ];
            }
        }
    }

    public function getJsonData()
    {
        $files = File::allFiles(base_path('Content'));

        $fileCollection = collect($files)->map(function ($file) {
            return $file->getRelativePathname();
        });

        $json = $fileCollection->map(function ($path) {
            $data = [
                "content" => Markdown::convert($this->disk->get($path))->getContent(),
                "brand" => 'S88pay',
            ];

            $this->getArticlesData($data);
        });

        return $json;
    }
}
