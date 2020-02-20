<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contatos;

/**
 * ContatosSearch represents the model behind the search form of `backend\models\Contatos`.
 */
class ContatosSearch extends Contatos
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'concelho_id', 'canal_id', 'tipo_id', 'nubCartoesAngariados', 'user_id'], 'integer'],
            [['clienteNovo', 'FocalPoint', 'contato', 'email', 'data', 'interacoes1', 'observacao', 'interacoes2', 'interacoes3', 'interacoes4', 'interacoes5', 'produtosGCVT', 'clienteConcorrencia', 'produtoConcorrencia', 'informacaoAdicional', 'propostaAceite', 'servicos', 'observacao2', 'motivoRecusa', 'observacao3', 'observacao4', 'nivelSatisfacao', 'razoesinsatisfacao', 'alertas', 'oportunidades', 'acoes', 'observacao5', 'dataNotificacao', 'EstadoNotificacao', 'observacaoNotificacao',  'globalSearch'], 'safe'],
            [['valorServicoTotal', 'valorPrestacao'], 'number'],
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
            $query = Contatos::find()
                ->where('user_id = ' . Yii::$app->user->identity->id )
                ->orderby('id desc');
        } else {
            $query = Contatos::find()
                ->orderby('id desc');
        }
        $query->joinWith(['cliente']);

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
        //     'cliente_id' => $this->cliente_id,
        //     'concelho_id' => $this->concelho_id,
        //     'canal_id' => $this->canal_id,
        //     'data' => $this->data,
        //     'tipo_id' => $this->tipo_id,
        //     'valorServicoTotal' => $this->valorServicoTotal,
        //     'valorPrestacao' => $this->valorPrestacao,
        //     'nubCartoesAngariados' => $this->nubCartoesAngariados,
        //     'dataNotificacao' => $this->dataNotificacao,
        //     'user_id' => $this->user_id,
        // ]);

        $query->orFilterWhere(['like', 'clienteNovo', $this->globalSearch])
            ->orFilterWhere(['like', 'FocalPoint', $this->globalSearch])
            ->orFilterWhere(['like', 'cliente.nome', $this->globalSearch])
            ->orFilterWhere(['like', 'cliente.cod_cliente', $this->globalSearch])
            ->orFilterWhere(['like', 'nome', $this->globalSearch])
            ->orFilterWhere(['like', 'contato', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'interacoes1', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao', $this->globalSearch])
            ->orFilterWhere(['like', 'interacoes2', $this->globalSearch])
            ->orFilterWhere(['like', 'interacoes3', $this->globalSearch])
            ->orFilterWhere(['like', 'interacoes4', $this->globalSearch])
            ->orFilterWhere(['like', 'interacoes5', $this->globalSearch])
            ->orFilterWhere(['like', 'produtosGCVT', $this->globalSearch])
            ->orFilterWhere(['like', 'clienteConcorrencia', $this->globalSearch])
            ->orFilterWhere(['like', 'produtoConcorrencia', $this->globalSearch])
            ->orFilterWhere(['like', 'informacaoAdicional', $this->globalSearch])
            ->orFilterWhere(['like', 'propostaAceite', $this->globalSearch])
            ->orFilterWhere(['like', 'servicos', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao2', $this->globalSearch])
            ->orFilterWhere(['like', 'motivoRecusa', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao3', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao4', $this->globalSearch])
            ->orFilterWhere(['like', 'nivelSatisfacao', $this->globalSearch])
            ->orFilterWhere(['like', 'razoesinsatisfacao', $this->globalSearch])
            ->orFilterWhere(['like', 'alertas', $this->globalSearch])
            ->orFilterWhere(['like', 'oportunidades', $this->globalSearch])
            ->orFilterWhere(['like', 'acoes', $this->globalSearch])
            ->orFilterWhere(['like', 'observacao5', $this->globalSearch])
            ->orFilterWhere(['like', 'EstadoNotificacao', $this->globalSearch])
            ->orFilterWhere(['like', 'observacaoNotificacao', $this->globalSearch]);

        return $dataProvider;
    }
}
