<?php

return [
    'aliyun' => [
        'accessKey' => env('ALIYUN_ACCESSKEY'),
        'secret' => env('ALIYUN_SECRET'),
    ],


    'opensearch' => [
        'host' => env('OPENSEARCH_APP_HOST', 'http://opensearch-cn-hangzhou.aliyuncs.com'),

        'apps' => [
            'biw' => [
                'appName' => env('OPENSEARCH_APP_BIW_NAME'), // 应用名称id
                'appGroupIdentity' => env('OPENSEARCH_APP_BIW_APP_GROUP_IDENTITY'),// 应用名称
                'hits' => env('OPENSEARCH_APP_BIW_HITS', 20), // 设置返回结果的条数
                'format' => env('OPENSEARCH_APP_BIW_FORMAT', 'json'), // 返回值类型
                'summary' => env('OPENSEARCH_APP_BIW_SUMMARY'),// 高亮显示字段，可追加css样式
                'keywords' => env('OPENSEARCH_APP_BIW_KEYWORDS'), // 高频词汇分析
                'start' => env('OPENSEARCH_APP_BIW_START'), // 设置返回结果的偏移量
                'tables' => [
                    'table' => env('OPENSEARCH_TABLE_NAME'),
                ],
                'suggestions' => [ // 下拉提示模型名称
                    'goodsName' => env('OPENSEARCH_APP_BIW_SUGGESTIONS_GOODS_NAME'), // 商品名称下拉提示模型名
                ],
            ],
        ],

        'debug' => env('OPENSEARCH_DEBUG'),
    ],
];


