<?php

/* @var $this View */

/* @var $content string */

use admin\assets\AssetApp;
use admin\assets\AssetJQuery;
use keygenqt\sbAdminPlus\AssetSbAdminPlus;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

AssetSbAdminPlus::register($this);
AssetApp::register($this);
AssetJQuery::register($this);

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

    <link rel="shortcut icon" href="<?= Url::toRoute('@web/images/favicon.png') ?>" type="image/x-icon">

    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="page-top" id="page-top">
<?php $this->beginBody() ?>


<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center" href="/">
            <div class="sidebar-brand-icon">
                <i class="fas fa-book-reader"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MyLibrary</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::toRoute(['site/index']) ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Content
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item <?= Yii::$app->controller->id == 'book' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::toRoute(['book/index']) ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Books</span>
            </a>
        </li>

        <li class="nav-item <?= Yii::$app->controller->id == 'genre' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::toRoute(['genre/index']) ?>">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Genres</span>
            </a>
        </li>

        <li class="nav-item <?= Yii::$app->controller->id == 'user' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::toRoute(['user/index']) ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li class="nav-item <?= Yii::$app->controller->id == 'notification' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= Url::toRoute(['notification/index']) ?>">
                <i class="fas fa-fw fa-paper-plane"></i>
                <span>Notifications</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800" style="margin-left: 10px;"><?= str_replace("MyLibrary | ", "", $this->title) ?></h1>
                </div>

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Yii::$app->user->identity->nickname ?></span>
                            <?= Html::img('@web/images/' . Yii::$app->user->identity->avatar . '.png', [
                                'alt' => 'avatar',
                                'class' => 'img-profile rounded-circle'
                            ]); ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= Url::toRoute(['user/update', 'id' => Yii::$app->user->identity->getId()]) ?>">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Edit Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <?= $content ?>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; MyLibrary <?= date("Y"); ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= Url::toRoute(['site/logout']) ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
