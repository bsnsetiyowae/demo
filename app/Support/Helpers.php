<?php

namespace App\Support;

class Helpers
{

    public static function getRootDomain($url)
    {
        $host = parse_url($url, PHP_URL_HOST) ?? $url;

        // Pecah domain berdasarkan titik
        $parts = explode('.', $host);
        $count = count($parts);

        // Ambil dua bagian terakhir atau tiga jika TLD dua karakter
        return $count >= 3 && strlen(end($parts)) == 2
            ? implode('.', array_slice($parts, -3))
            : implode('.', array_slice($parts, -2));
    }
}
