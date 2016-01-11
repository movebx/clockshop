<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Url;

$this->title = 'Каталог часов, патриотические часы для настоящих патриотов';

$this->registerCssFile('@web/css/shop/catalog.css');

$products = $dataProvider->getModels();
$pagination = $dataProvider->getPagination();
$sort = $dataProvider->getSort();

$cutDescription = function($str){
    if(iconv_strlen($str) > 50)
        return substr($str, 0, 50).'...';

    return $str;
};

?>



<?php
if(!empty($products))
{
    echo '<div class="col-md-12 text-left sort" >Сортировать по: '.$sort->link('clk_name').' | '.$sort->link('price').'</div>';
    foreach($products as $product): ?>

        <div class="col-md-4 product">
            <div class="col-md-12 product-item">
                <div class="product-header"><a href="<?= Url::to(['shop/product', 'id' => $product->id]) ?>"><span class="text-info"><?= $product->clk_name ?></span></a></div>
                <div class="col-md-12"><a href="<?= Url::to(['shop/product', 'id' => $product->id]) ?>"><img class="img-rounded catalog-thumb" src="<?= '/'.\app\modules\admin\models\AddProduct::THUMBS_IMAGES_PATH.$product->images->img_name ?>"></a></div>
                <div class="product-price"><h3>Цена: <?= $product->price ?><small> грн</small></h3></div>
                <div class="product-btn"><a href="<?= Url::to(['shop/cart-add', 'id' => $product->id]) ?>" class="btn btn-success btn-block"><span class="glyphicon glyphicon-shopping-cart"></span> В корзину <span class="glyphicon glyphicon-plus"></span></a></div>

            </div>
        </div>

<?php endforeach; }?>

<div class="row">
    <div class="col-md-offset-4 col-md-4 pages">
        <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
