<?php

/* @var $this yii\web\View */

/* @var $model Notification */

use common\models\Notification;
use admin\widgets\Alert;
use yii\bootstrap4\Button;
use yii\grid\Column;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

$this->title = 'MyLibrary | Notifications';

echo Html::tag('div', Alert::widget(), ['class' => 'container-fluid']);

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
                    . Html::tag('span', ' Add Notification', ['class' => 'text']),
                'encodeLabel' => false,
                'options' => [
                    'class' => 'btn btn-success btn-icon-split',
                    'href' => Url::toRoute(['notification/update'])
                ],
            ]),
        ]),
        'dataProvider' => $model->search(Yii::$app->request->getQueryParams()),
        'filterModel' => $model,
        'columns' => [
            [
                'attribute' => 'body',
                'format' => 'raw',
                'value' => function ($model) {
                    return empty($model->body) ? null : Html::encode($model->body);
                },
                'contentOptions' => ['style' => 'vertical-align: middle;'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    Notification::STATUS_OPEN => ucfirst(Notification::STATUS_OPEN),
                    Notification::STATUS_DONE => ucfirst(Notification::STATUS_DONE),
                    Notification::STATUS_PENDING => ucfirst(Notification::STATUS_PENDING),
                    Notification::STATUS_ERROR => ucfirst(Notification::STATUS_ERROR),
                ],
                'value' => function ($model) {
                    /* @var $model Notification */
                    switch ($model->status) {
                        case Notification::STATUS_OPEN:
                            return Html::label(ucfirst($model->status), '', ['class' => 'card border-left-primary']);
                        case Notification::STATUS_DONE:
                            return Html::label(ucfirst($model->status), '', ['class' => 'card border-left-success']);
                        case Notification::STATUS_PENDING:
                            return Html::label(ucfirst($model->status), '', ['class' => 'card border-left-warning']);
                        case Notification::STATUS_ERROR:
                            return Html::label(ucfirst($model->status), '', ['class' => 'card border-left-danger']);
                    }
                    return Html::label(ucfirst($model->status), '', ['class' => 'card border-left-secondary']);
                },
                'headerOptions' => ['style' => 'width: 145px;'],
                'contentOptions' => ['style' => 'width: 145px;vertical-align: middle;'],
            ],
            [
                'class' => Column::class,
                'header' => '',
                'content' => function ($model) {

                    $buttons = Button::widget([
                        'tagName' => 'a',
                        'label' => Html::tag('i', '', ['class' => 'fas fa-pencil-alt']),
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn-primary',
                            'href' => Url::toRoute(['notification/update', 'id' => $model->id])
                        ],
                    ]);

                    $buttons .= Button::widget([
                        'tagName' => 'a',
                        'label' => Html::tag('i', '', ['class' => 'fas fa-trash-alt']),
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn-danger',
                            'href' => 'javascript:void(0)',
                            'data-toggle' => 'modal',
                            'data-target' => '#deleteModal',
                            'onclick' => '$("#delete-link").attr("href", "' . Url::toRoute(['notification/delete', 'id' => $model->id]) . '");'
                        ],
                    ]);

                    return $buttons;

                },
                'headerOptions' => ['class' => 'settings', 'style' => 'width: 120px;'],
                'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 120px;text-align: center;'],
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