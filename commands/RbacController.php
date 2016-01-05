<?php

namespace app\commands;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionExe()
    {
        $auth = \Yii::$app->authManager;

        $rUser = $auth->createRole('user');
        $rAdmin = $auth->createRole('admin');

        $auth->add($rUser);
        $auth->add($rAdmin);

        $auth->addChild($rAdmin, $rUser);

        $auth->assign($rAdmin, 1);

        echo 'DONE!';
    }
}