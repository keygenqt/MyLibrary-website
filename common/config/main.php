<?php

use common\models\User;
use keygenqt\components\ImageHandler;

Yii::setAlias('@common', dirname(__DIR__));

return [
    'timeZone' => 'Europe/Moscow',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'ih' => [
            'class' => ImageHandler::class,
        ],
        'request' => [
            'cookieValidationKey' => 'fyc^yo,$pmnr52.VrU{1ES.A[B3Da%NJOy}}h-0W){k#NA$z)~',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => User::class,
            'enableAutoLogin' => true,
        ],
    ]
];
