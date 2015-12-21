<?php


namespace app\modules\admin\models;

use Yii;
use Imagine\Gd\Imagine;
use yii\base\Model;
use Imagine\Filter\Transformation;
use Imagine\Image\Box;


class AddImage extends Model
{
    const FULL_IMAGES_PATH = 'images/portfolio/full/';
    const THUMBS_IMAGES_PATH = 'images/portfolio/thumbs/';
    const THUMB_REDUCTION = 3;

    public $alt;
    /* @var $imageFiles array */
    public $imageFiles;

    public function rules()
    {
        return [
            ['imageFiles', 'image', 'maxFiles' => 5, 'extensions' => 'png, jpg, jpeg, gif',
                'skipOnEmpty' => false, 'maxSize' => 5000000],
            ['alt', 'required'],
            ['alt', 'string', 'length' => [5, 30]],
        ];
    }



    public function uploadImages()
    {
        if($this->validate())
        {
            $transformation = new Transformation();
            $imagine = new Imagine();

            //$randHeight = function() {
              //return rand(250, 330);
            //};

            foreach($this->imageFiles as $file)
            {/* @var $file \yii\web\UploadedFile */

                $imageRandName = Yii::$app->security->generateRandomString(12);
                $fullImagePath = self::FULL_IMAGES_PATH.$imageRandName.'.'.$file->extension;
                $file->saveAs($fullImagePath);

                $imgSizeReduct = function ($side = 'width') use ($fullImagePath) {
                    $size = getimagesize($fullImagePath);
                    if($side === 'width')
                        return ($size[0] / self::THUMB_REDUCTION);
                    if($side === 'height')
                        return ($size[1] / self::THUMB_REDUCTION);
                };

                $transformation->thumbnail(new Box($imgSizeReduct('width'), $imgSizeReduct('height')))
                    ->save(Yii::getAlias('@webroot/'.self::THUMBS_IMAGES_PATH.$imageRandName.'.'.$file->extension));

                $transformation->apply($imagine->open(Yii::getAlias('@webroot/'.self::FULL_IMAGES_PATH.$imageRandName.'.'.$file->extension)));

                $images = new Images();
                $images->name = $imageRandName.'.'.$file->extension;
                $images->alt = $this->alt;

                if(!$images->save())
                {
                    Yii::$app->session->addFlash('danger', 'Image not saved into data base!');
                    return false;
                }
            }

            Yii::$app->session->addFlash('success', 'Image uploaded successfully');
            return true;
        }
        Yii::$app->session->addFlash('danger', 'Incorrect data');
        return false;
    }

    static public function getFullImagesPath()
    {
        return self::FULL_IMAGES_PATH;
    }

    static public function getThumbsImagesPath()
    {
        return self::THUMBS_IMAGES_PATH;
    }
}