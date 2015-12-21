<?php

echo '<h1>Add product</h1>';

$form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'description')->textarea(['rows' => 15]);
echo $form->field($model, 'displayType')->textInput();
echo $form->field($model, 'mechanismType')->textInput();
echo $form->field($model, 'starpType')->textInput();
echo $form->field($model, 'sex')->dropDownList([1 => 'Male', 2 => 'Female', 3 => 'Unisex']);
echo $form->field($model, 'images')->fileInput();
echo $form->field($model, 'price')->textInput();

echo '<div class="btn-group">';
echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-success btn-lg']);
echo \yii\helpers\Html::resetButton('Reset', ['class' => 'btn btn-default btn-lg']);

echo '</div>';
$form->end();