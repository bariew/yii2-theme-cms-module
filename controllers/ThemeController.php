<?php

namespace bariew\themeModule\controllers;
use bariew\themeModule\models\Theme;
use yii\web\Controller;

class ThemeController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new Theme();
        $dataProvider = $searchModel->search();
        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionCreate()
    {
        $model = new Theme();
        $model->scenario = Theme::SCENARIO_CREATE;
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        }
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = Theme::findOne($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        }
        return $this->render('update', compact('model'));
    }

    public function actionDelete($id)
    {
        Theme::findOne($id)->delete();
        $this->redirect(['index']);
    }

    public function actionSelect($id)
    {
        Theme::findOne($id)->select();
        $this->redirect(['index']);
    }
}