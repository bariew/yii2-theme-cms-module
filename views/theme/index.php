<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var bariew\userModule\models\UserSearch $searchModel
 */

$this->title = Yii::t('modules/theme', 'Themes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo Html::a(Yii::t('modules/theme', 'Upload new theme'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'isSelected',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return Html::activeCheckbox($data, 'isSelected', [
                        'data-url'  => \yii\helpers\Url::toRoute(["select", "id" => $data->id]),
                        'onchange' => 'window.location.href = $(this).data("url");'
                    ]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'options' => ['width'=>'50px'],
                'contentOptions' => function ($model) {
                    return $model->id == 'null' ? ['class' => 'hide'] : [];
                }
            ],
        ],
    ]); ?>

</div>
