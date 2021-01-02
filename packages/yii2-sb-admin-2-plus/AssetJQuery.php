<?php

namespace keygenqt\sbAdminPlus;

use yii\web\AssetBundle;

class AssetJQuery extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $sourcePath = '@vendor/bower-asset/jquery/dist';

    /**
     * @var mixed|null|string
     */
    public $js = [
        'jquery.js',
    ];
}
