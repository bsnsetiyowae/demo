<?php

namespace App\Support;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
        // check view
        abort_if(!view()->exists($view), 404);

        $path = "$this->locale/$this->type/$this->page.md";

        // check path
        abort_if(!$this->disk->exists($path), 404);

        if (App::environment('production')) {
            $cachedData = Cache::rememberForever('view.' . md5($path), function () use ($path) {
                $markdown = Markdown::convert($this->disk->get($path));
                return [
                    'content' => $markdown->getContent(),
                    'frontmatter' => method_exists($markdown, 'getFrontMatter') ? $markdown->getFrontMatter() : null,
                    'index' => $this->getSidebar(),
                    'brand' => 'S88pay',
                ];
            });
        } else {
            $markdown = Markdown::convert($this->disk->get($path));
            $cachedData = [
                'content' => $markdown->getContent(),
                'frontmatter' => method_exists($markdown, 'getFrontMatter') ? $markdown->getFrontMatter() : null,
                'index' => $this->getSidebar(),
                'brand' => 'S88pay',
            ];
        }

        return view($view, $cachedData);
    }

    public function getSidebar()
    {
        return Markdown::convert($this->disk->get("$this->locale/docs/documentation.md"));
    }
}
