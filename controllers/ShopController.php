<?php

namespace app\controllers;

use app\models\ConfirmOrder;
use app\modules\admin\models\Customers;
use app\modules\admin\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class ShopController extends Controller
{
    public function behaviors()
    {
        return [
            'verb' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'confirm-order' => ['post']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction'
            ]
        ];
    }

    public function actionCart()
    {
        $cart = Yii::$app->session->get('cart');
        $products = NULL;

        if(!empty($cart))
            $products = Products::findAll($cart);

        return $this->render('cart', ['products' => $products]);
    }

    public function actionConfirmOrder()
    {
        $confirmOrder = new ConfirmOrder();
        $confirmOrder->load(Yii::$app->request->post());

        if($confirmOrder->validate())
        {
            $confirmOrder->save();

            Yii::$app->session->open();
            Yii::$app->session->remove('cart');
            Yii::$app->session->addFlash('order-success', 'Заказ успешно подтверждён, мы свяжемся с Вами в самое близжайшее время');
            return $this->redirect('/shop/index');
        }

        foreach($confirmOrder->getErrors() as $error)
            Yii::$app->session->addFlash('order-error', $error);
        return $this->redirect('/shop/cart');
    }

    public function actionCartAdd($id)
    {
        $session = Yii::$app->session;
        $session->open();
            $_SESSION['cart'][] = $id;
        //$session->destroy();
        $session->close();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return true;
    }

    public function actionDetailView($id)
    {
        $product = Products::findOne($id);

        return $this->render('detail-view', ['product' => $product]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDel()
    {
        Yii::$app->session->removeAllFlashes();
        print_r(Yii::$app->session->allFlashes);

        echo 'Done!';
    }
}