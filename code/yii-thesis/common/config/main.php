<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'translator' => [
            'class' => 'common\components\translator\Translators',
        ],
        'helpers' => [
            'class' => 'common\components\Helpers',
        ],
        'dbpedia' => [
            'class' => 'common\components\DBPedia',
        ],
    ],
];
