<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var bariew\userModule\models\UserSearch $searchModel
 */

$this->title = 'Themes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo Html::a('Upload new theme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}', 'options' => ['width'=>'50px']],
        ],
    ]); ?>

</div>
