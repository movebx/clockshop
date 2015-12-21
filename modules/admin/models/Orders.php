<?php

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class Orders extends ActiveRecord
{
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id' => 'product_id']);
    }
}