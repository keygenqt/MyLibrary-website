<?php

/* @var $this yii\web\View */

/* @var $model User */

use admin\assets\AssetJQuery;
use admin\widgets\Alert;
use common\components\Helper;
use common\models\User;
use kartik\switchinput\SwitchInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = $model->isNewRecord ? 'Add User' : 'Update User';

AssetJQuery::register($this);

echo Html::tag('div', Alert::widget(), ['class' => 'container-fluid']);

?>

<div class="container-fluid">

    <?php $form = ActiveForm::begin(Helper::getFormParams()); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-default block-summary">
                <?php if ($model->isNewRecord): ?>
                    You can add a user here.
                <?php else: ?>
                    You can correct the user here.
                <?php endif; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-sm-12'>
                    <?= $form->field($model, 'avatar')->dropDownList(ArrayHelper::merge(['' => ''], User::avatars())) ?>
                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'email') ?>
                    <?php endif; ?>
                    <?= $form->field($model, 'nickname') ?>
                    <?= $form->field($model, 'website') ?>
                    <?= $form->field($model, 'location') ?>
                    <?= $form->field($model, 'bio')->textarea(['rows' => 5]) ?>
                    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::merge(['' => ''], [
                        'USER' => 'User',
                        'ADMIN' => 'Admin'
                    ])) ?>
                    <?= $form->field($model, 'enabled')->widget(SwitchInput::class, [
                        'type' => SwitchInput::CHECKBOX,
                        'containerOptions' => [
                            'class' => 'switch-input'
                        ]
                    ]) ?>

                    <hr>

                    <?= $form->field($model, '_password')->label($model->isNewRecord ? 'Password' : 'Update Password') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?= Html::submitButton(
            Html::tag('span',
                Html::tag('i', '', ['class' => 'fas fa-check']), ['class' => 'icon text-white-50']) .
            Html::tag('span', 'Save User', ['class' => 'text']), ['class' => 'btn btn-success btn-icon-split ml-auto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>






