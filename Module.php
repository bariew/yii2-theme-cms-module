<?php

namespace bariew\themeModule;
/**
 * Module class file.
 * @copyright (c) 2014, Galament
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Module for site-wide themes.
 * 
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class Module extends \yii\base\Module
{
    public $params = [
        'menu'  => [
            'label'    => 'Settings',
            'items' => [
                ['label'    => 'Themes', 'url' => ['/theme/theme/index']]
            ]
        ]
    ];
}
