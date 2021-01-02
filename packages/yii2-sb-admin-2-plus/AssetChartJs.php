<?php

namespace keygenqt\sbAdminPlus;

use yii\web\AssetBundle;

class AssetChartJs extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $sourcePath = '@vendor/nnnick/chartjs/dist';

    /**
     * @var mixed|null|string
     */
    public $js = [
        'Chart.js',
    ];
}
