<?php

namespace app\models;

use app\modules\admin\models\Customers;
use app\modules\admin\models\OrderProducts;
use app\modules\admin\models\Orders;
use yii\base\Model;

class ConfirmOrder extends Model
{
    public $products;
    public $c_name;
    public $c_phone;
    public $captcha;

    public function rules()
    {
        return [
            [['products', 'c_name', 'c_phone'], 'required'],
            ['captcha', 'captcha', 'captchaAction' => 'shop/captcha'],
            ['c_phone', 'match', 'pattern' => '/^[\d+]{9,}$/i']
        ];
    }

    public function load($data, $formName = null)
    {
        $this->products = empty($data['products']) ? NULL : $data['products'];
        $this->c_name = empty($data['c_name']) ? NULL : $data['c_name'];
        $this->c_phone = empty($data['c_phone']) ? NULL : $data['c_phone'];
        $this->captcha = empty($data['captcha']) ? NULL : $data['captcha'];

    }

    public function save()
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try
        {
            $customers = new Customers();
            $customers->c_name = $this->c_name;
            $customers->c_phone = $this->c_phone;
            $customers->save();

            $orders = new Orders();
            $orders->customer_id = $customers->id;
            $orders->save();

            foreach($this->products as $product)
            {
                    $orderProducts = new OrderProducts();
                    $orderProducts->order_id = $orders->id;
                    $orderProducts->product_id = $product['id'];
                    $orderProducts->product_amount = $product['amount'];
                    $orderProducts->save();
            }

            $transaction->commit();
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            \Yii::error($e->getMessage());
            throw $e;
        }
    }

}