<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var bariew\themeModule\models\Theme $model
 */

$this->title = 'Update Theme: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?php echo Html::encode($model->id) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
