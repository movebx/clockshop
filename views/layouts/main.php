<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\ShopAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/* @var $this \yii\web\View */
/* @var $content string */


ShopAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="<?= Yii::$app->charset ?>">

        <?php
            echo Html::csrfMetaTags();
            $this->head();
        ?>
    </head>
<body>
<?php $this->beginBody(); ?>



<?php if(Yii::$app->user->can('admin'))
{
?>
<div class="go-cpanel">
    <a href="<?= Url::to('/admin/cpanel/index') ?>">cpanel</a>
</div>
<?php
}
?>

<header>
<?php

    NavBar::begin([
        'brandLabel' => 'Site Name',
    ]);

    echo Nav::widget([
        'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-shopping-cart"></span> Корзина',
                'url' => Url::to(['shop/cart']),
                'encode' => false
            ]
        ],
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ]
    ]);


    NavBar::end();

?>
</header>

    <div class="container">
        <div class="row">
            <div class="col-md-3 main-item side">afafa</div>
            <div class="col-md-8 content">
                <?= $content ?>
            </div>
        </div>
    </div>

<div class="footer">

</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
