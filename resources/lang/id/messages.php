<?php

return [

    'greeting' => 'Halo dunia',
    'guides' => [
        'title' => 'Panduan',
        'sections' => [
            'api-overview' => [
                'href' => '/api',
                'name' => 'Ikhtisar API',
                'description' => 'Pelajari dasar-dasar dan ikhtisar dari API.',
            ],
            'get-started' => [
                'href' => '/api/get-started',
                'name' => 'Memulai dengan API',
                'description' => 'Cara menyiapkan dan membuat permintaan API pertama Anda.',
            ],
            'authentication' => [
                'href' => '/api/authentication',
                'name' => 'Autentikasi & Keamanan',
                'description' => 'Jelajahi autentikasi dan keamanan dari API.',
            ]
        ],
    ],
    'resources' => [
        "title" => "Sumber Tambahan",
        'description' => "Jika Anda memerlukan informasi lebih lanjut, jelajahi sumber daya berikut:",
        "sections" => [
            'merchant-currency' => [
                'href' => '/docs/currency',
                'name' => 'Mata Uang Pedagang',
                'description' => 'Pelajari tentang mata uang pedagang yang tersedia',
            ],
            'banks-codes' => [
                'href' => '/docs/banks',
                'name' => 'Kode Bank',
                'description' => 'Temukan kode bank yang terkait dengan mata uang yang tersedia.',
            ],
            'transaction-status' => [
                'href' => '/api/status',
                'name' => 'Status Transaksi',
                'description' => 'Mengerti status transaksi untuk operasi deposit dan penarikan.',
            ],
            'errors-list' => [
                'href' => '/api/errors',
                'name' => 'Daftar Error',
                'description' => 'Jelajahi daftar error yang mungkin terjadi.',
            ],
        ]
    ],
];
