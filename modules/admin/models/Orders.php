<?php

namespace app\modules\admin\models;


use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Orders extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'TimeStamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['order_time'],
                    //ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    public function getOrderTime()
    {
        return date('d-m-Y', $this->order_time);
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['order_id' => 'id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }
}