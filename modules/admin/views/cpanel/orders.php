<?php




foreach($model as $order)
{



    $str = $order->customer->c_name.' заказал: ';

    foreach($order->products as $product)
        $str .= $product->id.',';

    $str .= ' в количестве '. $order->product_amount.'<br />';
    echo $str;
}