<?php


namespace app\modules\admin\controllers;


use app\modules\admin\models\AddProduct;
use app\modules\admin\models\Characteristics;
use app\modules\admin\models\Images;
use app\modules\admin\models\Orders;
use app\modules\admin\models\Products;
use app\modules\admin\models\UpdateProduct;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\modules\admin\models\ProductsSearch;


class CpanelController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $GET = Yii::$app->request->get();
        $dataProvider = $searchModel->search($GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionAddProduct()
    {
        $model = new AddProduct();
        $POST = Yii::$app->request->post();


        if(Yii::$app->request->isPost && $model->load($POST))
        {
            $model->images = UploadedFile::getInstance($model, 'images');
            if($model->validate())
                $model->save();
        }

        return $this->render('add-product', ['model' => $model]);
    }

    public function actionOrders()
    {
        $model = Orders::find()->joinWith(['customer', 'products'])->groupBy(['customer_id'])->all();

        return $this->render('orders', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = new UpdateProduct();
        $model->id = $id;

        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate())
            $model->confirmUpdate();

        $model->fillInTheRest();
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $product = Products::findOne($id);
        $characteristics = Characteristics::findOne($product->characteristics_id);
        $image = Images::findOne(['product_id' => $product->id]);

        $transaction = Products::getDb()->beginTransaction();

        try
        {
            if(!$product->delete())
                throw new \Exception('Product not deleted');
            if(!$characteristics->delete())
                throw new \Exception('Characteristics not deleted');
            if(!$image->delete())
                throw new \Exception('Image not deleted, from data base');
            if(!unlink(Yii::getAlias('@webroot/'.AddProduct::THUMBS_IMAGES_PATH.$image->img_name)))
                throw new \Exception('Thumb image not deleted');
            if(!unlink(Yii::getAlias('@webroot/'.AddProduct::FULL_IMAGES_PATH.$image->img_name)))
                throw new \Exception('Full image not deleted');

            $transaction->commit();
            Yii::$app->session->addFlash('success', 'Product successfully deleted');
            $this->goBack();
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }
    }
}