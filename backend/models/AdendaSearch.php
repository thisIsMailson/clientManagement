<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Adendas;

/**
 * AdendaSearch represents the model behind the search form of `backend\models\Adendas`.
 */
class AdendaSearch extends Adendas
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'cidencia_id', 'periodoFidelizacao', 'cartoesPosPago', 'cartoesPrePago', 'totalCartoes', 'quantidadeTotal', 'user_id'], 'integer'],
            [['nomecli', 'dataInicioContrato', 'dataFimContrato', 'servicos', 'dataEntrega', 'guiaSaida', 'numTalaoDeposito', 'numRecibo', 'simulador','globalSearch'], 'safe'],
            [['valorPosPago', 'valorPrePago', 'total', 'carregamentoFaturMini', 'precoTotal', 'valorMaximo', 'valorPago', 'valorAdicional', 'totalPropostapagamento', 'taxaEsforcoNegociavel', 'taxaEsforcoTotal'], 'number'],
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
        if (Yii::$app->user->identity->view_option === 0) {
            $query = Adendas::find()
                ->where('user_id = ' . Yii::$app->user->identity->id )
                ->orderby('id desc');
        } else {
            $query = Adendas::find()
                ->orderby('id desc');
        }
        

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
        //     'cidencia_id' => $this->cidencia_id,
        //     'dataInicioContrato' => $this->dataInicioContrato,
        //     'dataFimContrato' => $this->dataFimContrato,
        //     'periodoFidelizacao' => $this->periodoFidelizacao,
        //     'cartoesPosPago' => $this->cartoesPosPago,
        //     'cartoesPrePago' => $this->cartoesPrePago,
        //     'totalCartoes' => $this->totalCartoes,
        //     'valorPosPago' => $this->valorPosPago,
        //     'valorPrePago' => $this->valorPrePago,
        //     'total' => $this->total,
        //     'carregamentoFaturMini' => $this->carregamentoFaturMini,
        //     'quantidadeTotal' => $this->quantidadeTotal,
        //     'precoTotal' => $this->precoTotal,
        //     'dataEntrega' => $this->dataEntrega,
        //     'valorMaximo' => $this->valorMaximo,
        //     'valorPago' => $this->valorPago,
        //     'valorAdicional' => $this->valorAdicional,
        //     'totalPropostapagamento' => $this->totalPropostapagamento,
        //     'taxaEsforcoNegociavel' => $this->taxaEsforcoNegociavel,
        //     'taxaEsforcoTotal' => $this->taxaEsforcoTotal,
        //     'user_id' => $this->user_id,
        // ]);

        $query->orFilterWhere(['like', 'nomecli', $this->globalSearch])
            ->orFilterWhere(['like', 'servicos', $this->globalSearch])
            ->orFilterWhere(['like', 'guiaSaida', $this->globalSearch])
            ->orFilterWhere(['like', 'numTalaoDeposito', $this->globalSearch])
            ->orFilterWhere(['like', 'numRecibo', $this->globalSearch])
            ->orFilterWhere(['like', 'simulador', $this->globalSearch]);

        return $dataProvider;
    }
}
