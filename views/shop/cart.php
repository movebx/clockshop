<?php

use yii\captcha\Captcha;

/* @var $this yii\web\View */

$this->title = 'Корзина';

$isProductsEmpty = empty($products);

$this->registerJsFile('@web/js/shop/cart.js', ['position' => \yii\web\View::POS_END]);


?>
<h1>Корзина</h1>
<form action="<?= \yii\helpers\Url::to('/shop/confirm-order') ?>" method="post">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
<table id="cart" class="table">
    <tr>
        <td><b>Наименование товара</b></td>
        <td><b>Цена, грн</b></td>
        <td><b>Количество</b></td>
        <td><b>Сумма, грн</b></td>
    </tr>
<?php
if(!$isProductsEmpty)
{
    $total = 0;
    $pg = 0;
    foreach($products as $product)
    {
        $total += ($product->price * 1);
        echo '<tr>';
            echo '<td><i><a href="/shop/product/detail?id='.$product->id.'">'.$product->clk_name.'</a></i><input type="hidden" name="products[group'.$pg.'][id]" value="'.$product->id.'"></td>';
            echo '<td>'.$product->price.'</td>';
            echo '<td id="amount"><input class="amount" type="text" name="products[group'.$pg.'][amount]" value="1"></td>';
            echo '<td data-sum="this">'.($product->price * 1).'</td>';
        echo '</tr>';
        $pg++;
    }

    echo '</table>';
?>
    <hr>
    <div class="col-md-offset-9 col-md-3 text-center"><h3><ins id="total">Итого: <?= $total ?></ins></h3></div>
    <div class="col-md-12 text-center"><h1>Контактные данные</h1></div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="c-name" class="require">Ваше Имя</label>
            <input class="form-control" id="c-name" type="text" name="c_name" placeholder="Введите имя">
        </div>
        <div class="form-group">
            <label for="c-name" class="require">Ваш Телефон</label>
            <input class="form-control" id="c-phone" type="text" name="c_phone" placeholder="Введите телефон">
        </div>
    </div>
    <div class="form-group">
        <?= Captcha::widget([
            'captchaAction' => 'shop/captcha',
            'name' => 'captcha',
            'template' => '<div class="col-md-12">{image}</div><label for="w0" class="col-md-12"><b>Введите код на картинке</b></label><div class="col-md-6">{input}</div>',
        ]) ?>
    </div>
    <div class="col-md-4 col-md-offset-8">
        <div class="cart-button">
        <?= \yii\helpers\Html::submitButton('Подтвердить заказ', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        </div>
    </div>

<?php
}
else
{
    echo '</table>';
    echo '<span class="col-md-12 text-center">Корзина пуста</span>';
}
?>
</form>

