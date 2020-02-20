<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `backend\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cod_cliente', 'nome', 'estado', 'tipo_cliente', 'gestor', 'cod_gp', 'created_at', 'updated_at'], 'safe'],
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
        $query = Clientes::find()->orderby('id desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [ 'pageSize' => 11 ],
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
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);

        $query->orFilterWhere(['like', 'cod_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'nome', $this->globalSearch])
            ->orFilterWhere(['like', 'estado', $this->globalSearch])
            ->orFilterWhere(['like', 'tipo_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'gestor', $this->globalSearch])
            ->orFilterWhere(['like', 'cod_gp', $this->globalSearch]);

        return $dataProvider;
    }
}
