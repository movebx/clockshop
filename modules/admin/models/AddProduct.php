<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use Imagine\Filter\Transformation;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use yii\web\UploadedFile;

class AddProduct extends Model
{
    const FULL_IMAGES_PATH = 'images/products/full/';
    const THUMBS_IMAGES_PATH = 'images/products/thumbs/';
    const THUMB_REDUCTION = 2;

    public $name;
    public $description;
    public $price;
    public $displayType;
    public $mechanismType;
    public $starpType;
    public $sex;
    public $images;


    public function rules()
    {
        return [
            [['name', 'description', 'price', 'displayType', 'mechanismType', 'starpType', 'sex', 'images'], 'required'],
            ['images', 'image', 'extensions' => 'png, jpg, gif, jpeg', 'maxSize' => 5000000, 'skipOnEmpty' => false]
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();


        try
        {
            $characteristics = new Characteristics();
            $characteristics->display_type = $this->displayType;
            $characteristics->mechanism_type = $this->mechanismType;
            $characteristics->starp_type = $this->starpType;
            $characteristics->sex = $this->sex;

            if(!$characteristics->save(false))
                throw new \Exception('Charasteristic not save, transaction rollback');

            $products = new Products();
            $products->clk_name = $this->name;
            $products->clk_description = $this->description;
            $products->characteristics_id = $characteristics->id;
            $products->price = $this->price;

            if(!$products->save(false))
                throw new \Exception('Product not save, transaction rollback');



            $hashName = Yii::$app->security->generateRandomString();
            $fullImagePath = self::FULL_IMAGES_PATH.$hashName.'.'.$this->images->extension;

            if(!$this->images->saveAs($fullImagePath))
                throw new \Exception('Image not save in full image path');

            $imgSizeReduct = function ($side = 'width') use ($fullImagePath) {
                $size = getimagesize($fullImagePath);
                if($side === 'width')
                    return ($size[0] / self::THUMB_REDUCTION);
                if($side === 'height')
                    return ($size[1] / self::THUMB_REDUCTION);
            };

            $images = new Images();
            $transformation = new Transformation();
            $imagine = new Imagine();

            $transformation->thumbnail(new Box($imgSizeReduct('width'), $imgSizeReduct('height')))
                ->save(Yii::getAlias('@webroot/'.self::THUMBS_IMAGES_PATH.$hashName.'.'.$this->images->extension));

            $transformation->apply($imagine->open(Yii::getAlias('@webroot/'.self::FULL_IMAGES_PATH.$hashName.'.'.$this->images->extension)));

            $images->product_id = $products->id;
            $images->img_name = $hashName.'.'.$this->images->extension;

            if(!$images->save(false))
                throw new \Exception('Images not save, transaction rollback');


            $transaction->commit();
            Yii::$app->session->addFlash('success', 'Product successfully added');
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }
    }
}