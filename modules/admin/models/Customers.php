<?php

namespace app\modules\admin\models;


use yii\db\ActiveRecord;

class Customers extends ActiveRecord
{
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'id']);
    }
}