<?php


namespace app\modules\admin\models;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ProductsSearch extends ActiveRecord
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['characteristics.display_type', 'characteristics.mechanism_type', 'characteristics.starp_type', 'characteristics.sex']);
    }

    static public function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['clk_name', 'clk_description', 'characteristics.display_type', 'characteristics.mechanism_type', 'characteristics.starp_type', 'characteristics.sex'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Products::find()->joinWith(['characteristics']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                    'clk_name' => SORT_ASC,
                    'characteristics.display_type' => SORT_ASC,
                    'characteristics.mechanism_type' => SORT_ASC,
                    'characteristics.starp_type' => SORT_ASC,
                ],
                'attributes' => [
                    'id',
                    'clk_name',
                    'characteristics.display_type',
                    'characteristics.starp_type',
                    'characteristics.mechanism_type',
                ]
            ],
            'key' => 'id'

        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }


        $query
            ->andFilterWhere(['products.id' => $this->id])
            ->andFilterWhere(['like', 'clk_name', $this->clk_name])
            ->andFilterWhere(['like', 'clk_description', $this->clk_description])
            ->andFilterWhere(['like', 'characteristics.display_type', $this->getAttribute('characteristics.display_type')])
            ->andFilterWhere(['like', 'characteristics.mechanism_type', $this->getAttribute('characteristics.mechanism_type')])
            ->andFilterWhere(['like', 'characteristics.starp_type', $this->getAttribute('characteristics.starp_type')]);


        return $dataProvider;

    }
}