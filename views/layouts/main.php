<?php

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

<?php

    NavBar::begin([
        'brandLabel' => 'ClockShop',
    ]);

    echo Nav::widget([
        'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-shopping-cart"></span> Корзина',
                'url' => '#',
                'encode' => false
            ]
        ],
        'options' => [
            'class' => 'navbar-nav navbar-right'
        ]
    ]);


    NavBar::end();

?>

    <div class="container">
        <?= $content ?>
    </div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
