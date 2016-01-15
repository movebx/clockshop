<?php

use yii\helpers\Url;

$this->registerCssFile('@web/css/shop/detail-view.css');
$this->title = $product->clk_name;

?>

<div class="row">
    <div class="col-md-4">
        <div class="col-md-12"><img src="<?= '/'.\app\modules\admin\models\AddProduct::THUMBS_IMAGES_PATH.$product->images->img_name ?>" class="product-thumb"></div>
        <div class="col-md-12"><h3 class="text-info product-price">Цена: <?= $product->price ?><small class="text-info"> грн</small></h3></div>
        <div class="col-md-12"><a href="<?= Url::to(['shop/cart-add', 'id' => $product->id]) ?>" class="btn btn-success btn-block"><span class="glyphicon glyphicon-shopping-cart"></span> В корзину <span class="glyphicon glyphicon-plus"></span></a></div>
    </div>
    <div class="col-md-8">
        <div class="col-md-12"><h2 class="text-info"><?= $product->clk_name ?></h2></div>
        <div class="col-md-12 flag-color">
            <h4><b>Характеристики:</b></h4>
            <div><b>Пол:</b> <?php switch($product->characteristics->sex){
                    case 1: echo 'Мужской'; break;
                    case 2: echo 'Женский'; break;
                    case 3: echo 'Унисекс'; break;
                }?></div>
            <div><b>Механизм:</b> <?= $product->characteristics->mechanism_type ?></div>
            <div><b>Индикация:</b> <?= $product->characteristics->display_type ?></div>
            <div><b>Ремешок:</b> <?= $product->characteristics->starp_type ?></div>
            <h4><b>Опсиание:</b></h4>
            <div><?= $product->clk_description ?></div>
        </div>
    </div>
</div>
