<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\ShopAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/* @var $this \yii\web\View */
/* @var $content string */

$amountProductsInCart = count(Yii::$app->session->get('cart'));

$cartLabel = '<span class="glyphicon glyphicon-shopping-cart"></span> Корзина';
if($amountProductsInCart)
    $cartLabel .= '<span class="badge">'.$amountProductsInCart.'</span>';


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
        'brandLabel' => 'Часы для настоящих патриотов',
    ]);

    echo Nav::widget([
        'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-list-alt"></span> Каталог',
                'url' => Url::to(['shop/catalog']),
                'encode' => false
            ],

        ],
        'options' => [
            'class' => 'navbar-nav navbar-left'
        ]
    ]);



    echo Nav::widget([
        'items' => [
            [
                'label' => $cartLabel,
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

    <div class="container-fluid main">
        <div class="row">
            <div class="col-md-offset-3 col-md-6"><img class="flag" src="/images/shop/ukraine-flag.png" alt="Флаг укрины, часы для настощих патриотов"> </div>
            <div class="col-md-3 main-item">с 9:00 до 21:00 <p><span class="glyphicon glyphicon-phone"></span> Телефон: +38(050)6627376</p></div>
        </div>
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                <div class="col-md-12 main-item">
                    <ul class="menu">
                        <li><a href="/">главная</a></li>
                        <li><a href="<?= Url::to(['shop/catalog']) ?>">каталог часов</a></li>
                        <li><a href="<?= Url::to(['shop/oplata']) ?>">оплата и доставка</a></li>
                        <li><a href="<?= Url::to(['shop/contacts']) ?>">контакты</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 content">
                <?= $content ?>
            </div>
        </div>
    </div>

<div class="col-md-12 foot">

</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
