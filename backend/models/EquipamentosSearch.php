<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Equipamentos;

/**
 * EquipamentosSearch represents the model behind the search form of `backend\models\Equipamentos`.
 */
class EquipamentosSearch extends Equipamentos
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'marca', 'estado_equipamento'], 'safe'],
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
        $query = Equipamentos::find()->orderby('nome asc');

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
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'preco' => $this->preco,
        // ]);

        $query->orFilterWhere(['like', 'nome', $this->globalSearch])
            ->orFilterWhere(['like', 'marca', $this->globalSearch])
            ->orFilterWhere(['like', 'estado_equipamento', $this->globalSearch]);

        return $dataProvider;
    }
}
