<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var bariew\userModule\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('modules/theme', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
