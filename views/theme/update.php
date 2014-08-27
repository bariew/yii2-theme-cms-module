<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var bariew\themeModule\models\Theme $model
 */

$this->title = Yii::t('modules/theme', 'Update Theme {name}', ['name' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/theme', 'Themes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('modules/theme', 'Update');
?>
<div class="user-update">

    <h1><?php echo Html::encode($model->id) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
