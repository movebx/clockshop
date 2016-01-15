<?php

namespace app\controllers;

use app\models\ConfirmOrder;
use app\modules\admin\models\Products;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        if(!isset($_SESSION['cart']))
            $_SESSION['cart'][] = $id;

        if(!in_array($id, $_SESSION['cart']))
            $_SESSION['cart'][] = $id;
        //$session->destroy();
        $session->close();

        return $this->redirect('/shop/catalog');
    }

    public function actionCartDel($id)
    {
        Yii::$app->session->open();
        foreach($_SESSION['cart'] as $key => $value)
            if($value === $id)
                unset($_SESSION['cart'][$key]);

        if(!empty($_SESSION['cart']))
            ksort($_SESSION['cart']);
        Yii::$app->session->close();

        return $this->redirect('/shop/cart');
    }

    public function actionProduct($id)
    {
        $product = Products::find()->joinWith(['images', 'characteristics'])->where(['products.id' => $id])->one();
        if(!$product)
            throw new NotFoundHttpException('Product Not Found');

        return $this->render('detail-view', ['product' => $product]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCatalog()
    {
        $query = Products::find()->joinWith(['images', 'characteristics']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3
            ],
            'sort' => [
                'attributes' => [
                    'price' => ['label' => 'Цене'],
                    'clk_name' => ['label' => 'Названию']
                ]
            ]
        ]);

        return $this->render('catalog', ['dataProvider' => $dataProvider]);
    }

    public function actionOplata()
    {
        return $this->render('oplata');
    }

    public function actionContacts()
    {
        return $this->render('contacts');
    }

    public function actionDel()
    {
        Yii::$app->session->removeAllFlashes();
        Yii::$app->session->remove('cart');
        print_r(Yii::$app->session->allFlashes);

        echo 'Done!';
    }
}