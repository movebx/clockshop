<?php
/* @var $images array */
/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */


echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id', 'clk_name', 'clk_description',
        [
            'class' => 'yii\grid\DataColumn',
            'value' => function($data)
            {
                switch($data->characteristics->sex)
                {
                    case 1: return 'Мужской';
                    case 2: return 'Женский';
                    case 3: return 'Уни';
                }
            },
            'label' => 'Sex'
        ],
        'characteristics.display_type',
        'characteristics.mechanism_type',
        'characteristics.starp_type',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}'
        ]
    ]
]);


?>
