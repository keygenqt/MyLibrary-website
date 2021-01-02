<?php

/* @var $this yii\web\View */

/* @var $model Book */

use common\components\Helper;
use admin\controllers\AjaxController;
use common\models\Book;
use admin\widgets\Alert;
use kartik\switchinput\SwitchInput;
use keygenqt\autocompleteAjax\AutocompleteAjax;
use keygenqt\imageAjax\ImageAjax;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = $model->isNewRecord ? 'Add Book' : 'Update Book';

echo Html::tag('div', Alert::widget(), ['class' => 'container-fluid']);

?>

<div class="container-fluid">

    <?php $form = ActiveForm::begin(Helper::getFormParams()); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-default block-summary">
                <?php if ($model->isNewRecord): ?>
                    You can add a book here, just like in the application.
                <?php else: ?>
                    You can correct the book here, it will also change in the application.
                <?php endif; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-sm-12'>
                    <?= $form->field($model, 'image')->widget(ImageAjax::class, [
                        'btnDelete' => false,
                        'btnSelect' => 'Choose',
                        'url' => ['ajax/upload-image', 'type' => AjaxController::IMAGE_BOOK],
                    ]) ?>
                    <?= $form->field($model, 'user_id')->widget(AutocompleteAjax::class, [
                        'url' => ['ajax/search'],
                        'options' => ['placeholder' => 'Find by user email or user id.']
                    ]) ?>
                    <?= $form->field($model, 'genre_id')->widget(AutocompleteAjax::class, [
                        'url' => ['ajax/search-genre'],
                        'options' => ['placeholder' => 'Find by genre name or genre id.']
                    ]) ?>
                    <?= $form->field($model, 'cover_type')->dropDownList(ArrayHelper::merge(['' => ''], [
                        'Soft' => 'Soft',
                        'Solid' => 'Solid',
                        'Other' => 'Other'
                    ])) ?>
                    <?= $form->field($model, 'title') ?>
                    <?= $form->field($model, 'author') ?>
                    <?= $form->field($model, 'publisher') ?>
                    <?= $form->field($model, 'isbn') ?>
                    <?= $form->field($model, 'year') ?>
                    <?= $form->field($model, 'number_of_pages') ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => 8]) ?>
                    <?= $form->field($model, 'sale')->widget(SwitchInput::class, [
                        'type' => SwitchInput::CHECKBOX,
                        'containerOptions' => [
                            'class' => 'switch-input'
                        ]
                    ]) ?>
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
            Html::tag('span', 'Save Book', ['class' => 'text']), ['class' => 'btn btn-success btn-icon-split ml-auto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>






