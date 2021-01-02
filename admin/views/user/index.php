<?php

/* @var $this yii\web\View */

/* @var $model User */

use common\models\User;
use yii\bootstrap4\Button;
use yii\grid\Column;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

$this->title = 'MyLibrary | Users';

try {
    echo GridView::widget([
        'id' => 'grid',
        'tableOptions' => [
            'class' => 'table table-bordered dataTable',
            'width' => '100%',
            'cellspacing' => '0'
        ],
        'pager' => [
            'class' => '\yii\bootstrap4\LinkPager',
        ],
        'layout' => $this->render('../layouts/grid_view_render', [
            'button' => Button::widget([
                'tagName' => 'a',
                'label' => Html::tag('span', Html::tag('i', '', ['class' => 'fas fa-plus fa-sm text-white-50']), ['class' => 'icon text-white-50'])
                    . Html::tag('span', ' Add User', ['class' => 'text']),
                'encodeLabel' => false,
                'options' => [
                    'class' => 'btn btn-success btn-icon-split',
                    'href' => Url::toRoute(['user/update'])
                ],
            ]),
        ]),
        'dataProvider' => $model->search(Yii::$app->request->getQueryParams()),
        'filterModel' => $model,
        'columns' => [
            [
                'attribute' => 'nickname',
                'format' => 'raw',
                'value' => function ($model) {
                    return empty($model->nickname) ? null : Html::encode($model->nickname);
                },
                'contentOptions' => ['style' => 'vertical-align: middle;'],
            ],
            [
                'attribute' => 'email',
                'format' => 'raw',
                'value' => function ($model) {
                    return empty($model->email) ? null : Html::a($model->email, 'mailto:' . $model->email);
                },
                'contentOptions' => ['style' => 'vertical-align: middle;'],
            ],
            [
                'attribute' => 'role',
                'format' => 'raw',
                'filter' => [
                    'ADMIN' => 'Admin',
                    'USER' => 'User',
                ],
                'value' => function ($model) {
                    return $model->role == 'ADMIN' ? Html::label('Admin', '', ['class' => 'card border-left-warning']) : Html::label('User', '', ['class' => 'card border-left-primary']);
                },
                'headerOptions' => ['style' => 'width: 145px;'],
                'contentOptions' => ['style' => 'width: 145px;vertical-align: middle;'],
            ],
            [
                'attribute' => 'enabled',
                'format' => 'raw',
                'filter' => [
                    'Disabled',
                    'Enabled',
                ],
                'value' => function ($model) {
                    return $model->enabled ? Html::label('Enabled', '', ['class' => 'card border-left-success']) : Html::label('Disabled', '', ['class' => 'card border-left-danger']);
                },
                'headerOptions' => ['style' => 'width: 145px;'],
                'contentOptions' => ['style' => 'width: 145px;vertical-align: middle;'],
            ],
            [
                'class' => Column::class,
                'header' => '',
                'content' => function ($model) {
                    /* @var $model User */
                    return Button::widget([
                        'tagName' => 'a',
                        'label' => Html::tag('i', '', ['class' => 'fas fa-pencil-alt']),
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn-primary',
                            'href' => Url::toRoute(['user/update', 'id' => $model->id])
                        ],
                    ]);
                },
                'headerOptions' => ['class' => 'settings', 'style' => 'width: 75px;'],
                'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;'],
            ],
        ]
    ]);

} catch (Exception $e) {
    if (YII_DEBUG) {
        throw new RuntimeException($e);
    } else {
        throw new ServerErrorHttpException('An error occurred on the server.');
    }
}