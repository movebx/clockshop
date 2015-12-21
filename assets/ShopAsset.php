<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class ShopAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css =[
        'css/layout/main.css'
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

}