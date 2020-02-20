<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adendas".
 *
 * @property string $id
 * @property string $cidencia_id
 * @property string $nomecli
 * @property string $dataInicioContrato
 * @property string $dataFimContrato
 * @property int $periodoFidelizacao
 * @property int $cartoesPosPago
 * @property int $cartoesPrePago
 * @property int $totalCartoes
 * @property double $valorPosPago
 * @property double $valorPrePago
 * @property double $total
 * @property double $carregamentoFaturMini
 * @property string $servicos
 * @property int $quantidadeTotal
 * @property double $precoTotal
 * @property string $dataEntrega
 * @property double $valorMaximo
 * @property double $valorPago
 * @property double $valorAdicional
 * @property double $totalPropostapagamento
 * @property string $guiaSaida
 * @property string $numTalaoDeposito
 * @property string $numRecibo
 * @property string $simulador
 * @property double $taxaEsforcoNegociavel
 * @property double $taxaEsforcoTotal
 * @property string $utilizador_id
 * @property int $user_id
 *
 * @property Cedencias $cidencia
 * @property User $user
 */
class Adendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adendas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cidencia_id', 'nomecli', 'dataInicioContrato', 'dataFimContrato', 'periodoFidelizacao', 'cartoesPosPago', 'cartoesPrePago', 'totalCartoes', 'valorPosPago', 'valorPrePago', 'total', 'carregamentoFaturMini', 'servicos', 'quantidadeTotal', 'precoTotal', 'dataEntrega', 'valorMaximo', 'valorPago', 'valorAdicional', 'totalPropostapagamento', 'guiaSaida', 'numTalaoDeposito', 'numRecibo', 'taxaEsforcoNegociavel', 'taxaEsforcoTotal', 'user_id'], 'required'],
            [['cidencia_id', 'cartoesPosPago', 'cartoesPrePago', 'totalCartoes', 'quantidadeTotal', 'user_id'], 'integer'],
            [['dataInicioContrato', 'dataFimContrato', 'dataEntrega'], 'safe'],
            [['valorPosPago', 'valorPrePago', 'total', 'carregamentoFaturMini', 'precoTotal', 'valorMaximo', 'valorPago', 'valorAdicional', 'totalPropostapagamento'], 'number'],
            [['nomecli', 'guiaSaida', 'numTalaoDeposito', 'numRecibo'], 'string', 'max' => 100],
            [['simulador'], 'string', 'max' => 20],
            [['cidencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cedencias::className(), 'targetAttribute' => ['cidencia_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'cidencia_id' => 'Nº cedência',
            'nomecli' => 'Nome do cliente',
            'dataInicioContrato' => 'Data Início Contrato',
            'dataFimContrato' => 'Data Fim Contrato',
            'periodoFidelizacao' => 'Periodo Fidelização',
            'cartoesPosPago' => 'Cartões Pós Pago',
            'cartoesPrePago' => 'Cartões Pré Pago',
            'totalCartoes' => 'Total Cartões',
            'valorPosPago' => 'Valor Pós Pago',
            'valorPrePago' => 'Valor Pré Pago',
            'total' => 'Total',
            'carregamentoFaturMini' => 'Carregamento/Fatura mín',
            'servicos' => 'Serviços',
            'quantidadeTotal' => 'Quantidade Total',
            'precoTotal' => 'Preço Total',
            'dataEntrega' => 'Data Entrega',
            'valorMaximo' => 'Valor Máximo',
            'valorPago' => 'Valor Pago',
            'valorAdicional' => 'Valor Adicional',
            'totalPropostapagamento' => 'Total Proposta pagamento',
            'guiaSaida' => 'Guia Saida',
            'numTalaoDeposito' => 'Num Talão Depósito',
            'numRecibo' => 'Num Recibo',
            'simulador' => 'Simulador',
            'taxaEsforcoNegociavel' => 'Taxa Esforço Negociável',
            'taxaEsforcoTotal' => 'Taxa Esforço Total',
            'user_id' => 'Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidencia()
    {
        return $this->hasOne(Cedencias::className(), ['id' => 'cidencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
