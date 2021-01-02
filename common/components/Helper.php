<?php

namespace common\components;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class Helper
{
    public static function getFormParams(): array
    {
        return [
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{endWrapper}"
            ],
            'enableClientValidation' => false,
            'enableAjaxValidation' => false,
            'options' => ['autocomplete' => 'off']
        ];
    }

    public static function getPercent1GbSize($path): int
    {
        $bytes = 0;
        $path = realpath($path);
        if ($path !== false && $path != '' && file_exists($path)) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
                /* @var $object SplFileInfo */
                $bytes += $object->getSize();
            }
        }
        return (int) ($bytes * 100 / 2147483648);
    }
}