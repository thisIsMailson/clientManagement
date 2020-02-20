<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HistoricoEquipamento;

/**
 * HistoricoEquipamentoSearch represents the model behind the search form of `backend\models\HistoricoEquipamento`.
 */
class HistoricoEquipamentoSearch extends HistoricoEquipamento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipamento_id', 'utilizador_id', 'user_id'], 'integer'],
            [['data_alteracao'], 'safe'],
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
        $query = HistoricoEquipamento::find();

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
            'data_alteracao' => $this->data_alteracao,
            'equipamento_id' => $this->equipamento_id,
            'utilizador_id' => $this->utilizador_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
