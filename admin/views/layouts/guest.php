<?php

/* @var $this View */

/* @var $content string */

use admin\assets\AssetApp;
use keygenqt\sbAdminPlus\AssetSbAdminPlus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

AssetSbAdminPlus::register($this);
AssetApp::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?= Url::toRoute('/images/favicon.png') ?>" type="image/x-icon">

    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="bg-gradient-primary">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
