<?php

/* @var $this yii\web\View */

/* @var $model Genre */

use common\models\Genre;
use yii\bootstrap4\Button;
use yii\grid\Column;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

$this->title = 'MyLibrary | Genres';

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
                    . Html::tag('span', ' Add Genre', ['class' => 'text']),
                'encodeLabel' => false,
                'options' => [
                    'class' => 'btn btn-success btn-icon-split',
                    'href' => Url::toRoute(['genre/update'])
                ],
            ]),
        ]),
        'dataProvider' => $model->search(Yii::$app->request->getQueryParams()),
        'filterModel' => $model,
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return empty($model->title) ? null : Html::encode($model->title);
                },
                'contentOptions' => ['style' => 'vertical-align: middle;'],
            ],
            [
                'attribute' => 'language',
                'format' => 'raw',
                'filter' => [
                    Genre::LANGUAGE_EN => Genre::LANGUAGE_EN,
                    Genre::LANGUAGE_RU => Genre::LANGUAGE_RU,
                ],
                'value' => function ($model) {
                    /* @var $model Genre */
                    switch ($model->language) {
                        case Genre::LANGUAGE_EN:
                            return Html::label($model->language, '', ['class' => 'card border-left-primary']);
                        case Genre::LANGUAGE_RU:
                            return Html::label($model->language, '', ['class' => 'card border-left-info']);
                    }
                    return Html::label($model->language, '', ['class' => 'card border-left-secondary']);
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
                    /* @var $model Genre */
                    return Button::widget([
                        'tagName' => 'a',
                        'label' => Html::tag('i', '', ['class' => 'fas fa-pencil-alt']),
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn-primary',
                            'href' => Url::toRoute(['genre/update', 'id' => $model->id])
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