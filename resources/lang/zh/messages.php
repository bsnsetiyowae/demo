<?php

return [
    'greeting' => '你好，世界',
    'guides' => [
        'title' => '指南',
        'sections' => [
            'api-overview' => [
                'href' => '/api',
                'name' => 'API 概述',
                'description' => '了解 API 的基础知识和概述。',
            ],
            'get-started' => [
                'href' => '/api/get-started',
                'name' => '开始使用 API',
                'description' => '如何设置并发出您的第一个 API 请求。',
            ],
            'authentication' => [
                'href' => '/api/authentication',
                'name' => '认证与安全',
                'description' => '探索 API 的认证与安全。',
            ]
        ],
    ],
    'resources' => [
        'title' => '附加资源',
        'description' => '如果您需要更多信息，请探索以下资源：',
        'sections' => [
            'merchant-currency' => [
                'href' => '/docs/currency',
                'name' => '商家货币',
                'description' => '了解可用的商家货币。',
            ],
            'banks-codes' => [
                'href' => '/docs/banks',
                'name' => '银行代码',
                'description' => '发现与可用货币相关的银行代码。',
            ],
            'transaction-status' => [
                'href' => '/api/status',
                'name' => '交易状态',
                'description' => '了解存款和提款操作的交易状态。',
            ],
            'errors-list' => [
                'href' => '/api/errors',
                'name' => '错误列表',
                'description' => '探索可能发生的错误列表。',
            ],
        ]
    ],

    'read-more' => '阅读更多',
    'on-page' => '本页内容'
];
