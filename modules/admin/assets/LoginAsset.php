<?php


namespace app\modules\admin\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets';

    public $css = ['css/login/login.css'];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}