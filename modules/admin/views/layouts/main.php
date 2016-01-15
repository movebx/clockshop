<?php
/* @var $content string */
/* @var $this \yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\assets\CpanelAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$this->title = 'Application control panel';
$flashBag = \Yii::$app->session->allFlashes;
?>

<?php CpanelAsset::register($this) ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= Html::encode($this->title) ?></title>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
        echo Html::csrfMetaTags();
        $this->head();
    ?>
</head>
<body>
<?php $this->beginBody()?>

<?php
NavBar::begin([
    'brandLabel' => '<span class="glyphicon glyphicon-home"></span>',
    'brandUrl' => '/',
    'options' => [
        'class' => 'navbar-inverse navbar-top',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => '<span class="glyphicon glyphicon-cog"></span>Cpanel',
            'url' => Url::to(['/admin/cpanel/index']),
            'encode' => false,
        ],
        [
            'label' => '<span class="glyphicon glyphicon-plus"></span>Add product',
            'url' => Url::to(['/admin/cpanel/add-product']),
            'encode' => false,
        ],
        [
            'label' => '<span class="glyphicon glyphicon-th-list"></span>Orders()',
            'url' => Url::to(['/admin/cpanel/orders']),
            'encode' => false,
        ]
    ]
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-off" style="color: white;"></span>',
                'url' => ['/admin/login/logout'],
                'encode' => false,
                //'linkOptions' => ['data-method' => 'post']
            ],
    ],
]);
NavBar::end();
?>

<div class="container">
    <?php
    if(!empty($flashBag))
        foreach($flashBag as $class => $messages)
            if($class === 'success' || $class === 'danger')
                foreach($messages as $message)
                {
                    ?>
                    <div class="row row-margin">
                        <div class="col-md-12 text-center">
                            <div id="alert-close" class="alert alert-<?= $class ?> "><strong><?= $class ?>!</strong> <?= $message ?></div>
                        </div>
                    </div>
                    <?php
                }
    ?>


    <div class="row">
        <div class="col-md-12">
            <?= $content ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12 footer">

        </div>
    </div>
</div>




<script>
    var alertClose = document.getElementById('alert-close');
    if(alertClose !== null)
        setTimeout(function()
        {
            $(alertClose).remove();
        }, 4000);
</script>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
