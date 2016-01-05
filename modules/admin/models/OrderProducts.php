<?php

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class OrderProducts extends ActiveRecord
{
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}