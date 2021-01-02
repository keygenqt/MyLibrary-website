<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\assets;

use yii\web\AssetBundle;

class AssetApp extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $basePath = '@webroot';
    /**
     * @var mixed|null|string
     */
    public $baseUrl = '@web';
    /**
     * @var mixed|null|array
     */
    public $css = [
        'css/site.css',
        'css/media.css',
    ];
}
