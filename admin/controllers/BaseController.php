<?php

namespace admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'guest'
            ],
        ];
    }
}
