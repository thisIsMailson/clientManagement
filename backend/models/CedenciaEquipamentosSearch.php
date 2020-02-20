<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CedenciaEquipamentos;

/**
 * CedenciaEquipamentosSearch represents the model behind the search form of `backend\models\CedenciaEquipamentos`.
 */
class CedenciaEquipamentosSearch extends CedenciaEquipamentos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipamento_id', 'cedencia_id', 'quantidade', 'PrecoTotal'], 'integer'],
            [['preco'], 'number'],
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
        $query = CedenciaEquipamentos::find();

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
            'equipamento_id' => $this->equipamento_id,
            'cedencia_id' => $this->cedencia_id,
            'quantidade' => $this->quantidade,
            'preco' => $this->preco,
            'PrecoTotal' => $this->PrecoTotal,
        ]);

        return $dataProvider;
    }
}
