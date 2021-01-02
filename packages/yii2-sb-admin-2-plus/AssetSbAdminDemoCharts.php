<?php

namespace keygenqt\sbAdminPlus;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author KeyGen <keygenqt@gmail.com>
 * @since 2.0
 */
class AssetSbAdminDemoCharts extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $sourcePath = '@vendor/npm-asset/startbootstrap-sb-admin-2';
    /**
     * @var mixed|null|array
     */
    public $js = [
        'js/demo/chart-area-demo.js',
        'js/demo/chart-pie-demo.js',
    ];
    /**
     * @var mixed|null|array
     */
    public $depends = [
        'keygenqt\sbAdminPlus\AssetSbAdmin',
    ];

}
