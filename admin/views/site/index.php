<?php

/* @var $this yii\web\View */

/* @var $percent1GbSize string */


use common\models\Book;
use common\models\Notification;
use common\models\User;
use admin\assets\AssetIndexCharts;
use common\models\UserToken;

$this->title = 'MyLibrary | Dashboard';

AssetIndexCharts::register($this);

?>

<script>
    var dataCartArea = [
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '1'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '2'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '3'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '4'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '5'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '6'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '7'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '8'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '9'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '10'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '11'])->count() ?>,
        <?= (int) User::find()->where(['enabled' => 1, 'MONTH(created_at)' => '12'])->count() ?>
    ]
    var dataCartPie = [
        <?= (int) UserToken::find()->where('DATE(updated_at) < NOW() - INTERVAL 5 DAY')->count() ?>,
        <?= (int) UserToken::find()->where('DATE(updated_at) >= NOW() - INTERVAL 5 DAY')->count() ?>,
        <?= (int) User::find()->where(['enabled' => 0])->count() ?>
    ]
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Number of books
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= Book::find()->where(['enabled' => 1])->count() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Number of users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= User::find()->where(['enabled' => 1])->count() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Sent notifications
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= Notification::find()->where(['status' => 'open'])->count() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                space
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $percent1GbSize ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                             style="width: <?= $percent1GbSize ?>>%" aria-valuenow="<?= $percent1GbSize ?>" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-server fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Activity Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Active
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Passive
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Block
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">General information</h6>
                </div>
                <div class="card-body">
                    <p>Administrative panel of the MyLibrary application.</p>
                    <p class="mb-0">MyLibrary is an application for cataloging your books library. The application is designed to help unite lovers of
                        literature. Find a rare book among users MyLibrary.</p>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->
