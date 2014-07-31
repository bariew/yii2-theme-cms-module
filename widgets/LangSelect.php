<?php
/**
 * LangSelect class file.
 * @copyright (c) 2014, Galament
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\themeModule\widgets;

use bariew\themeModule\models\MessageLanguage;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Dropdown for language selection.
 *
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class LangSelect extends Widget
{
    /**
     * @var string view file name.
     */
    public $view = 'langSelect';

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!\Yii::$app->has('db')) {
            return;
        }
        $model = new MessageLanguage();
        $model->scenario = $model::WIDGET_SCENARIO;
        $model->title = \Yii::$app->language;
        if ($model->load(\Yii::$app->request->post())) {
            unset($_GET['q']);
            $get = \Yii::$app->request->get();
            \Yii::$app->urlManager->setLang($model->title);
            \Yii::$app->controller->redirect(array_merge([\Yii::$app->request->baseUrl], $get));
        }
        return $this->render($this->view, compact('model'));
    }
}