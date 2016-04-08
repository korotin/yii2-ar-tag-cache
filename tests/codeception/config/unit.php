<?php

return [
    'id' => 'test',
    'basePath' => __DIR__.'/../../',
    'class' => 'yii\console\Application',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
