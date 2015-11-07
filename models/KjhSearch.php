<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kjh;

/**
 * KjhSearch represents the model behind the search form about `app\models\Kjh`.
 */
class KjhSearch extends Kjh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qh', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Kjh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'qh' => $this->qh,
            'n1' => $this->n1,
            'n2' => $this->n2,
            'n3' => $this->n3,
            'n4' => $this->n4,
            'n5' => $this->n5,
            'n6' => $this->n6,
            'n7' => $this->n7,
            'n8' => $this->n8,
        ]);

        return $dataProvider;
    }
}
