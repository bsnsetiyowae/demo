<?php

return [

    'greeting' => 'Hello world',
    'guides' => [
        'title' => 'Guides',
        'sections' => [
            'api-overview' => [
                'href' => '/api',
                'name' => 'Api Overview',
                'description' => 'Learn about the basics and overview of the API.',
            ],
            'get-started' => [
                'href' => '/api/get-started',
                'name' => 'Get started with the API',
                'description' => 'How to set up and make your first API requests.',
            ],
            'authentication' => [
                'href' => '/api/authentication',
                'name' => 'Authentication & Security',
                'description' => 'Explore authentication and security of the API.',
            ]
        ],
    ],
    'resources' => [
        "title" => "Additional Resources",
        'description' => "If you need further information, explore the following resources:",
        "sections" => [
            'merchant-currency' => [
                'href' => '/docs/currency',
                'name' => 'Merchant Currency',
                'description' => 'Learn about available merchant currency',
            ],
            'banks-codes' => [
                'href' => '/docs/banks',
                'name' => 'Banks Codes',
                'description' => 'Discover bank codes associated with available currencies.',
            ],
            'transaction-status' => [
                'href' => '/api/status',
                'name' => 'Transaction Status',
                'description' => 'Understand transaction statuses for deposit and payout operations.',
            ],
            'errors-list' => [
                'href' => '/api/errors',
                'name' => 'Errors List',
                'description' => 'Explore a list of possible errors that may occur.',
            ],
        ]
    ],
];
