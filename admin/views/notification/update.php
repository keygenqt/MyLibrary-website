<?php

/* @var $this yii\web\View */

/* @var $model Notification */

use admin\assets\AssetJQuery;
use common\components\Helper;
use common\models\Notification;
use admin\widgets\Alert;
use keygenqt\autocompleteAjax\AutocompleteAjax;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = $model->isNewRecord ? 'Add Notification' : 'Update Notification';

echo Html::tag('div', Alert::widget(), ['class' => 'container-fluid']);

?>

<div class="container-fluid">

    <?php $form = ActiveForm::begin(Helper::getFormParams()); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-default block-summary">
                <?php if ($model->isNewRecord): ?>
                    You can add a notification here.
                <?php else: ?>
                    You can correct the notification here.
                <?php endif; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-sm-12'>
                    <?= $form->field($model, 'user_id')->widget(AutocompleteAjax::class, [
                        'url' => ['ajax/search'],
                        'options' => ['placeholder' => 'Find by user email or user id.']
                    ]) ?>
                    <?= $form->field($model, 'channel_id') ?>
                    <?= $form->field($model, 'title') ?>
                    <?= $form->field($model, 'body') ?>
                    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::merge(['' => ''], [
                        'open' => 'Open',
                        'done' => 'Done',
                        'pending' => 'Pending',
                        'error' => 'Error',
                    ])) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?= Html::submitButton(
            Html::tag('span',
                Html::tag('i', '', ['class' => 'fas fa-check']), ['class' => 'icon text-white-50']) .
            Html::tag('span', 'Save Notification', ['class' => 'text']), ['class' => 'btn btn-success btn-icon-split ml-auto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>






