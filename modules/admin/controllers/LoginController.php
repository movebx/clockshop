<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\AdminLogin;
use yii\filters\AccessControl;

class LoginController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [

                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        if(!Yii::$app->user->isGuest)
            $this->redirect('/admin/cpanel');

        $model = new AdminLogin();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->validateData())
            {
                $model->login();
                $this->redirect('/admin/cpanel');
            }

            $model->addError('someone', 'Login or password are incorrect!');
        }

        return $this->renderPartial('index', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        $this->redirect('/admin/login');
    }
}