<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

class Products extends ActiveRecord
{

    public function getCharacteristics()
    {
        return $this->hasOne(Characteristics::className(), ['id' => 'characteristics_id']);
    }

    public function getImages()
    {
        return $this->hasOne(Images::className(), ['product_id' => 'id']);
    }
}