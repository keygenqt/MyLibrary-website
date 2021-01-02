<?php

namespace keygenqt\sbAdminPlus;

use yii\web\AssetBundle;

class AssetFontAwesome extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $sourcePath = '@vendor/fortawesome/font-awesome';

    /**
     * @var mixed|null|string
     */
    public $css = [
        'css/all.css',
    ];
}
