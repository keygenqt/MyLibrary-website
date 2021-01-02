<?php

/* @var $this yii\web\View */

/* @var $model Genre */

use common\components\Helper;
use common\models\Genre;
use admin\widgets\Alert;
use kartik\switchinput\SwitchInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = $model->isNewRecord ? 'Add Genre' : 'Update Genre';

echo Html::tag('div', Alert::widget(), ['class' => 'container-fluid']);

?>

<div class="container-fluid">

    <?php $form = ActiveForm::begin(Helper::getFormParams()); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-default block-summary">
                <?php if ($model->isNewRecord): ?>
                    You can add a genre here.
                <?php else: ?>
                    You can correct the genre here, it will also change in the application.
                <?php endif; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-sm-12'>
                    <?= $form->field($model, 'title') ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
                    <?= $form->field($model, 'language')->dropDownList(ArrayHelper::merge(['' => ''], [
                        'en-US' => 'en-US',
                        'ru-RU' => 'ru-RU'
                    ])) ?>
                    <?= $form->field($model, 'enabled')->widget(SwitchInput::class, [
                        'type' => SwitchInput::CHECKBOX,
                        'containerOptions' => [
                            'class' => 'switch-input'
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?= Html::submitButton(
            Html::tag('span',
                Html::tag('i', '', ['class' => 'fas fa-check']), ['class' => 'icon text-white-50']) .
            Html::tag('span', 'Save Genre', ['class' => 'text']), ['class' => 'btn btn-success btn-icon-split ml-auto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>






