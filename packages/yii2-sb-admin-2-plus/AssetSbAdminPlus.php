<?php
/*
 * Copyright 2020 Vitaliy Zarubin
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace keygenqt\sbAdminPlus;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author KeyGen <keygenqt@gmail.com>
 * @since 2.0
 */
class AssetSbAdminPlus extends AssetBundle
{
    /**
     * @var mixed|null|string
     */
    public $sourcePath = '@keygenqt/sbAdminPlus/assets';
    /**
     * @var mixed|null|array
     */
    public $css = [
        'css/main.css',
        'css/media.css',
    ];
    /**
     * @var mixed|null|array
     */
    public $js = [
        'js/main.js',
    ];

    public $depends = [
        'keygenqt\sbAdminPlus\AssetSbAdmin',
    ];

    public function init()
    {
        $this->cssOptions['position'] = View::POS_END;
        parent::init();
    }
}
