<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Notification;

/**
 * NotificationSearch represents the model behind the search form of `backend\models\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contato_id', 'user_id'], 'integer'],
            [['data', 'observacao', 'estado'], 'safe'],
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
        $query = Notification::find()->orderby('id desc');

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
            'id' => $this->id,
            'contato_id' => $this->contato_id,
            'user_id' => $this->user_id,
            'data' => $this->data,
        ]);

        $query->andFilterWhere(['like', 'observacao', $this->observacao])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
