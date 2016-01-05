<?php


namespace app\modules\admin;

use Yii;
use yii\base\Module;

class AdminModule extends Module
{

    public function init()
    {
        parent::init();

        Yii::$app->user->loginUrl = ['admin/login'];
        Yii::$app->user->identityClass = 'app\modules\admin\identity\Admin';


        Yii::configure($this, $this->config());
    }



    protected function config()
    {
        return [
            'layout' => 'main',
            'aliases' => [
                '@admin' => '@app/modules/admin'
            ]
        ];
    }

}