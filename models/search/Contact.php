<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contact as ContactModel;

/**
 * Contact represents the model behind the search form of `app\models\Contact`.
 */
class Contact extends ContactModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_contact', 'created_at'], 'integer'],
            [['name', 'phone', 'email', 'firm', 'comment', 'url'], 'safe'],
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
        $query = ContactModel::find();

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
            'id_contact' => $this->id_contact,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'firm', $this->firm])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
