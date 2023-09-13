<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subplace;

/**
 * SubplaceSearch represents the model behind the search form of `app\models\Subplace`.
 */
class SubplaceSearch extends Subplace
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subplace', 'id_place', 'id_media', 'price', 'price_type', 'area'], 'integer'],
            [['name', 'capacity', 'comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Subplace::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_subplace' => $this->id_subplace,
            'id_place' => $this->id_place,
            'id_media' => $this->id_media,
            'price' => $this->price,
            'price_type' => $this->price_type,
            'area' => $this->area,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'capacity', $this->capacity])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
