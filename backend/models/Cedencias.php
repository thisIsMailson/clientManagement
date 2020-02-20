<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cedencias".
 *
 * @property string $id
 * @property string $contato_id
 * @property string $id_cliente
 * @property string $refedilizacao
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
 * @property int $user_id
 *
 * @property Adendas[] $adendas
 * @property Clientes $cliente
 * @property Contatos $contato
 * @property User $user
 */
class Cedencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cedencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeCliente', 'refedilizacao', 'dataInicioContrato', 'dataFimContrato', 'periodoFidelizacao', 'cartoesPosPago', 'cartoesPrePago', 'totalCartoes', 'valorPosPago', 'valorPrePago', 'total', 'carregamentoFaturMini', 'servicos', 'quantidadeTotal', 'precoTotal', 'dataEntrega', 'valorMaximo', 'valorPago', 'valorAdicional', 'totalPropostapagamento', 'guiaSaida', 'numTalaoDeposito', 'numRecibo', 'taxaEsforcoNegociavel', 'taxaEsforcoTotal', 'user_id'], 'required'],
            [['contato_id', 'periodoFidelizacao', 'cartoesPosPago', 'cartoesPrePago', 'totalCartoes', 'quantidadeTotal', 'user_id'], 'integer'],
            [['dataInicioContrato', 'dataFimContrato', 'nomeCliente', 'dataEntrega'], 'safe'],
            [['valorPosPago', 'valorPrePago', 'total', 'carregamentoFaturMini', 'precoTotal', 'valorMaximo', 'valorPago', 'valorAdicional', 'totalPropostapagamento'], 'number'],
            [['refedilizacao', 'simulador'], 'string', 'max' => 15],
            [['guiaSaida', 'numTalaoDeposito', 'numRecibo'], 'string', 'max' => 100],
            [['contato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contatos::className(), 'targetAttribute' => ['contato_id' => 'id']],
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
            'contato_id' => 'Contato',
            'nomeCliente' => 'Nome cliente',
            'refedilizacao' => 'Refedilização',
            'dataInicioContrato' => 'Data Início Contrato',
            'dataFimContrato' => 'Data Fim Contrato',
            'periodoFidelizacao' => 'Período Fidelização',
            'cartoesPosPago' => 'Cartões Pós Pago',
            'cartoesPrePago' => 'Cartões Pré Pago',
            'totalCartoes' => 'Total Cartões',
            'valorPosPago' => 'Valor Pós Pago',
            'valorPrePago' => 'Valor Pré Pago',
            'total' => 'Total',
            'carregamentoFaturMini' => 'Carregamento Fatur Min',
            'servicos' => 'Serviços',
            'quantidadeTotal' => 'Quantidade Total',
            'precoTotal' => 'Preço Total',
            'dataEntrega' => 'Data Entrega',
            'valorMaximo' => 'Valor Máximo',
            'valorPago' => 'Valor Pago',
            'valorAdicional' => 'Valor Adicional',
            'totalPropostapagamento' => 'Total Proposta Pagamento',
            'guiaSaida' => 'Guia Saida',
            'numTalaoDeposito' => 'Nº Talão Depósito',
            'numRecibo' => 'Nº Recibo',
            'simulador' => 'Simulador',
            'taxaEsforcoNegociavel' => 'Taxa Esforço Aprovado',
            'taxaEsforcoTotal' => 'Taxa Esforço Total',
            'user_id' => 'Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdendas()
    {
        return $this->hasMany(Adendas::className(), ['cidencia_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContato()
    {
        return $this->hasOne(Contatos::className(), ['id' => 'contato_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
