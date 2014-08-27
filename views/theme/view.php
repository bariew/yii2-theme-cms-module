<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var bariew\userModule\models\User $model
 */

$this->title = Yii::t('modules/theme', 'Theme {name}', ['name' =>  $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('modules/theme', 'Themes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('modules/theme', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('modules/theme', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('modules/theme', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'username',
            'company_name',
            'statusName',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
