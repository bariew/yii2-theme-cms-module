<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var bariew\themeModule\models\Theme $model
 */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
