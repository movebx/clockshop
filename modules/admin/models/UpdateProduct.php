<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class UpdateProduct extends Model
{
    public $name;
    public $description;
    public $price;
    public $displayType;
    public $mechanismType;
    public $starpType;
    public $sex;

    public $id;

    public function rules()
    {
        return [
            [['name', 'description', 'price', 'displayType', 'mechanismType', 'starpType', 'sex'], 'required'],
            ['id', 'safe'],
        ];
    }

    public function confirmUpdate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $product = Products::findOne($this->id);
        $characteristic = Characteristics::findOne($product->characteristics_id);

        if(!($product && $characteristic))
            throw new NotFoundHttpException('Product Not Found');

        try
        {
            $product->clk_name = $this->name;
            $product->clk_description =$this->description;
            $product->price = $this->price;
            if(!$product->save())
                throw new \Exception('Product not update, transaction rollback');

            $characteristic->display_type = $this->displayType;
            $characteristic->mechanism_type = $this->mechanismType;
            $characteristic->starp_type = $this->starpType;
            $characteristic->sex = $this->sex;
            if(!$characteristic->save())
                throw new \Exception('Characteristic not update, transaction rollback');

            $transaction->commit();
            Yii::$app->session->addFlash('success', 'Product successfully updated');
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function fillInTheRest()
    {
        $product = Products::find()->with(['characteristics'])->where(['id' => $this->id])->one();
        if(!$product)
            throw new NotFoundHttpException('Product Not Found');

        $this->name = $product->clk_name;
        $this->description = $product->clk_description;
        $this->displayType = $product->characteristics->display_type;
        $this->mechanismType = $product->characteristics->mechanism_type;
        $this->starpType = $product->characteristics->starp_type;
        $this->sex = $product->characteristics->sex;
        $this->price = $product->price;

    }
}