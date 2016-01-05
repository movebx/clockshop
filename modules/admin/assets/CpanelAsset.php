<?php

namespace app\modules\admin\assets;


use yii\web\AssetBundle;

class CpanelAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets/css/cpanel';

    public $css = ['index.css', 'orders.css'];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}