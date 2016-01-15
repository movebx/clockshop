<?php
/* @var $this \yii\web\View */
use app\modules\admin\models\AddProduct;


?>

<h1>Orders</h1>

<table class="table table-striped">
    <tr>
        <td>Customer</td>
        <td>Phone</td>
        <td>Order time</td>
        <td>Products</td>
        <td>Actions</td>
    </tr>
<?php foreach($model as $order): ?>
    <tr>
        <td>
            <?= $order->customer->id.'-['.$order->customer->c_name.']' ?>
        </td>
        <td>
            <?= '<div>'.$order->customer->c_phone.'</div>' ?>
        </td>
        <td>
            <?= $order->getOrderTime() ?>
        </td>
        <td class="order-product">
            <?php foreach($order->orderProducts as $orderProduct){ ?>

                    <?= '<b>ID:</b> '.$orderProduct->product_id.'<br /> <b>Amount: </b>'.$orderProduct->product_amount.'<br /> <b>Product Name: </b><i>'.$orderProduct->product->clk_name.'</i> <img class="img-little" src="'.Yii::getAlias('@web/'.AddProduct::THUMBS_IMAGES_PATH.$orderProduct->product->images->img_name).'"><hr>' ?>


            <?php } ?>
        </td>
        <td>
            jjj
        </td>

    </tr>


<?php endforeach; ?>
</table>
