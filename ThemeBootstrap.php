<?php
/**
 * ThemeBootstrap class file
 * @copyright Copyright (c) 2014 Galament
 * @license http://www.yiiframework.com/license/
 */

namespace bariew\themeModule;

use yii\base\BootstrapInterface;
use yii\web\Application;

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

        if(!($app instanceof Application) || !isset($app->view->theme->pathMap['@app/modules'])){
            return true;
        }
        $modules = $app->extensions;
        $modulesPath = \Yii::$app->view->theme->pathMap['@app/modules'];
        $paths = [];
        foreach ($modules as $name => $config) {
            if (!isset($config['params']['moduleAlias'])) {
                continue;
            }
            $alias = $config['params']['moduleAlias'];
            $paths[$alias . "/views"] = $modulesPath . DIRECTORY_SEPARATOR . $name;
            $paths[$alias . "/widgets/views"] = $modulesPath . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'widgets';
        }
        \Yii::configure(\Yii::$app->view->theme, ['pathMap' => array_merge(\Yii::$app->view->theme->pathMap, $paths)]);
        return $this;
    }
}