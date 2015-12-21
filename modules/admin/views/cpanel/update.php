<?php


echo '<h1>Update product</h1>';

$form = \yii\bootstrap\ActiveForm::begin();

echo $form->field($model, 'name');
echo $form->field($model, 'description')->textarea(['rows' => 15]);
echo $form->field($model, 'displayType')->textInput();
echo $form->field($model, 'mechanismType')->textInput();
echo $form->field($model, 'starpType')->textInput();
echo $form->field($model, 'sex')->dropDownList([1 => 'Male', 2 => 'Female', 3 => 'Unisex']);
echo $form->field($model, 'price')->textInput();


echo \yii\bootstrap\Html::submitButton('Update', ['class' => 'btn btn-primary btn-lg btn-block']);

$form->end();