<?php
/**
 * ThemeBootstrap class file
 * @copyright Copyright (c) 2014 Galament
 * @license http://www.yiiframework.com/license/
 */

namespace bariew\themeModule;

use yii\base\BootstrapInterface;
/**
 * Bootstrap class initiates message controller.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class ThemeBootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        return true;
    }
}