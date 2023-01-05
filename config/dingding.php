<?php
return [
    // 是否开启报错写入
    'enabled' => true,

    // curl证书验证, 线下环境不用开启
    'curl_verify' =>"false",

    //机器人支持的关键词
    'key_words' => [
        'key_word_ERROR' => [//定义关键词
            'value' => 'ERROR',
            'at_mobiles' => []//定义对应关键词艾特的人
        ],
        'key_word_alarm' => [
            'value' => '警报器',
            'at_mobiles' => []
        ],
    ],

    // webhook的值,注意【如果更新了机器人信息，这个值会同步更新，请及时更新】
    'webhook' => "",
];