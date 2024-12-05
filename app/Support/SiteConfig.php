<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Traits\Macroable;

class SiteConfig
{
    use Macroable;

    public static function set($host = null)
    {
        if (is_null($host)) {
            $host = request()->getHost();
        }

        $host = Helpers::getRootDomain($host);

        // $siteConfig = Cache::rememberForever("config_site_{$host}", function () use ($host) {
            $sites = config('sites');
            $siteConfig = $sites[$host] ?? config('sites.default');
        // });

        Config::set('site', $siteConfig);
    }

    public static function get() {
        return Config::get('site', config('sites.default'));
    }

    public static function metadata($meta = [])
    {
        $siteConfig = self::get();


        $name = $siteConfig['name'];
        $title = $siteConfig['meta']['title'];
        $description = $meta['description'] ?? $siteConfig['meta']['description'];

        $metadata = "";

        if (empty($meta['title'])) {
            $metadata .= "<title>{$title}</title>";
        }

        if (!empty($meta['title'])) {
            $metadata .= "<title>{$meta['title']} - {$title}</title>";
        }
        
        if (!empty($description)) {
            $metadata .= "<meta name='description' content='{$description}'>";
        }

        if (!empty($name)) {
            $metadata .= "<link rel='icon' href='" . asset('favicon/'. strtolower($name) .'/favicon.ico') . "'>";
        }

        return $metadata;
    }
}
