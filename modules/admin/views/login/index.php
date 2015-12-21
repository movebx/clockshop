<?php
/* @var $this \yii\web\View */
/* @var $model \app\modules\admin\models\AdminLogin */

use yii\helpers\Html;
use app\modules\admin\assets\LoginAsset;
use yii\widgets\ActiveForm;

$this->title = 'Login admin panel';

?>

<?php LoginAsset::register($this) ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?= Html::encode($this->title) ?></title>

<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody()?>

<div class="container">
    <?php
    if(!empty($model->errors))
    {
        ?>
        <div id="error" class="col-lg-offset-4 col-lg-4">
            <div class="alert alert-danger error-center">
                <?= $model->errors['someone'][0] ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row margin-top">
        <div class="col-lg-offset-4 col-lg-4">
            <div class="form-label">
                <h1>Sign in</h1>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-login',
            ]); ?>

            <?= $form->field($model, 'login') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>


            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
    var error = document.getElementById('error');
    if(error !== null)
        setTimeout(function()
        {
            error.parentElement.removeChild(error);
        }, 4000);

</script>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>