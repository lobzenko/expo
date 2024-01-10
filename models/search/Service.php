<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service as ServiceModel;

/**
 * Service represents the model behind the search form of `app\models\Service`.
 */
class Service extends ServiceModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_service', 'id_media', 'state', 'ord'], 'integer'],
            [['name', 'description'], 'safe'],
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
        $query = ServiceModel::find()->orderBy('ord ASC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes'=>[''],
                'defaultOrder'=>'ord ASC'
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_service' => $this->id_service,
            'id_media' => $this->id_media,
            'state' => $this->state,
            'ord' => $this->ord,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
