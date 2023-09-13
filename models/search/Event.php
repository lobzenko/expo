<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event as EventModel;

/**
 * Event represents the model behind the search form of `app\models\Event`.
 */
class Event extends EventModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_event', 'id_media', 'date_begin', 'date_end', 'state'], 'integer'],
            [['name'], 'safe'],
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
        $query = EventModel::find();

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
            'id_event' => $this->id_event,
            'id_media' => $this->id_media,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
