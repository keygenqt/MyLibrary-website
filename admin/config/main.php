<?php

use yii\web\ErrorHandler;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

Yii::setAlias('@frontend', dirname(__DIR__) . '/../frontend');
Yii::setAlias('@admin', dirname(__DIR__));

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'name' => 'Admin Panel',
    'defaultRoute' => 'site/index',
    'controllerNamespace' => 'admin\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login'
            ]
        ],
        'errorHandler' => [
            'class' => ErrorHandler::class,
            'errorAction' => 'site/error'
        ],
    ],
    'params' => $params,
];