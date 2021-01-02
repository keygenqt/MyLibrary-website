<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'MyLibrary | Home';

?>

<style>
    .index-header-body {
        display: inline-block;
    }
</style>

<div class="about-page">
    <div class="round-top"></div>
    <div class="about-page-data">
        <div class="row">
            <div class="cell">
                <div class="phone">
                    <?= Html::img('images/about/phone.png') ?>
                </div>
            </div>
            <div class="cell">
                <div class="title">MyLibra<span>ry</span></div>
                <div class="text"><b>MyLibrary</b> is an application for cataloging your books library. The application is
                    designed to help unite lovers of literature. Find a rare book among users MyLibrary.
                </div>
            </div>
        </div>
    </div>
    <div class="round-bottom"></div>
</div>