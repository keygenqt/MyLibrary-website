<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Menu;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="<?= Url::toRoute('/images/common/favicon.png') ?>" type="image/x-icon">
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <div id="root">
        <div class="container-table">
            <div class="container-row">
                <div class="container-cell cell-header">
                    <div class="container-body">
                        <div class="menu">
                            <div class="menu-logo"><a href="/">MyLibra<span>ry</span></a></div>
                            <?= Menu::widget([
                                'encodeLabels' => false,
                                'options' => [
                                    'class' => 'menu-links'
                                ],
                                'items' => [
                                    [
                                        'label' => 'Admin Panel',
                                        'url' => '/admin',
                                        'visible' => !Yii::$app->user->isGuest
                                    ],
                                    [
                                        'label' => 'Home',
                                        'url' => ['site/index']
                                    ],
                                ]
                            ]); ?>
                        </div>
                        <div class="index-header-body">
                            <div class="index-header-text">Create you online library. Share and communicate. For free.</div>
                            <div class="index-header-subtext">A free, simple to use solution to allow to organize your library.</div>
                            <a target="_blank" rel="noreferrer" href="https://play.google.com/store/apps/details?id=com.keygenqt.mylibrary"
                               class="btn btn-green">Get Started Now &gt;</a></div>
                    </div>
                </div>
            </div>
            <div class="container-row">
                <div class="container-cell cell-body">
                    <div class="container-body about-page-container">
                        <?= $content ?>
                    </div>
                </div>
            </div>
            <div class="container-row">
                <div class="container-cell cell-footer">
                    <div class="container-body">
                        <div class="index-footer-body">
                            <div class="index-footer-text">If you have any questions, please contact. I will always be happy to help, if possible.
                                <div class="links"><a href="mailto:dev@keygenqt.com">dev@keygenqt.com</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>