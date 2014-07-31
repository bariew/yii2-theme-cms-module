<?php
/**
 * Language selection widget view file.
 * @copyright (c) 2014, Galament
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
$form = \yii\widgets\ActiveForm::begin(['fieldConfig' =>[
    'class' => \yii\widgets\ActiveField::className(),
    'template'  => '{input}'
]]);
echo $form->field($model, 'title')->dropDownList($model::listAll(), [
    'class'     => 'form-control',
    'onchange' => '$(this).parents("form").submit();'
]);
$form::end();