<?php

namespace admin\assets;

use yii\web\AssetBundle;
use yii\web\View;

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

    public function init()
    {
        $this->jsOptions['position'] = View::POS_HEAD;
        parent::init();
    }
}
