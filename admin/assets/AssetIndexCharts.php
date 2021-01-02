<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AssetIndexCharts extends AssetBundle
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
    public $js = [
        'js/chart-area.js',
        'js/chart-pie.js',
    ];
    /**
     * @var mixed|null|array
     */
    public $depends = [
        'keygenqt\sbAdminPlus\AssetSbAdminPlus',
    ];

    public function init()
    {
        $this->jsOptions['position'] = View::POS_END;
        parent::init();
    }
}
