<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model common\models\User */

use admin\assets\AssetApp;
use keygenqt\sbAdminPlus\AssetSbAdminPlus;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

AssetSbAdminPlus::register($this);
AssetApp::register($this);

?>
<div class="container">
    <div style="display: table;width: 100%;height: 100%;">
        <div style="width: 100%;display: table-cell;vertical-align: middle;">
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                        </div>
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'login-form',
                                            'layout' => 'horizontal',
                                            'options' => [
                                                'class' => 'user'
                                            ],
                                            'fieldConfig' => [
                                                'template' => "{input}\n{error}",
                                                'inputOptions' => ['class' => 'form-control form-control-user'],
                                            ],
                                            'enableClientValidation' => false
                                        ]); ?>

                                        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Enter Email Address...']) ?>

                                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                                        <?= $form->field($model, 'rememberMe')->checkbox([
                                            'template' => "<div class='custom-control custom-checkbox small'>{input} {label}</div>",
                                            'inputOptions' => ['class' => 'custom-control-input'],
                                            'labelOptions' => ['class' => 'custom-control-label'],
                                        ]) ?>

                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>

                                        <?php ActiveForm::end(); ?>

                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="mailto:dev@keygenqt.com">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
