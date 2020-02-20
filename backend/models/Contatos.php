<?php

namespace backend\models;

use Yii;
use backend\models\Tipo;

/**
 * This is the model class for table "contatos".
 *
 * @property string $id
 * @property string $cliente_id
 * @property string $clienteNovo
 * @property string $FocalPoint
 * @property string $concelho
 * @property string $contato
 * @property string $email
 * @property string $canal
 * @property string $data
 * @property string $tipo
 * @property string $interacoes1
 * @property string $observacao
 * @property string $interacoes2
 * @property string $interacoes3
 * @property string $interacoes4
 * @property string $interacoes5
 * @property string $produtosGCVT
 * @property string $clienteConcorrencia
 * @property string $produtoConcorrencia
 * @property string $informacaoAdicional
 * @property string $propostaAceite
 * @property string $servicos
 * @property double $valorServicoTotal
 * @property double $valorPrestacao
 * @property int $nubCartoesAngariados
 * @property string $observacao2
 * @property string $motivoRecusa
 * @property string $observacao3
 * @property string $observacao4
 * @property string $nivelSatisfacao
 * @property string $razoesinsatisfacao
 * @property string $alertas
 * @property string $oportunidades
 * @property string $acoes
 * @property string $observacao5
 * @property string $dataNotificacao
 * @property string $EstadoNotificacao
 * @property string $observacaoNotificacao
 * @property int $user_id
 *
 * @property Cedencias[] $cedencias
 * @property Clientes $cliente
 * @property User $user
 */
class Contatos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contatos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'clienteNovo', 'canal_id', 'data', 'tipo_id', 'user_id'], 'required'],
            [['cliente_id', 'nubCartoesAngariados', 'user_id'], 'integer'],
            [['cliente', 'data', 'dataNotificacao'], 'safe'],
            [['valorServicoTotal', 'valorPrestacao'], 'number'],
            [['clienteNovo', 'clienteConcorrencia', 'propostaAceite'], 'string', 'max' => 5],
            [['FocalPoint', 'concelho_id', 'tipo_id', 'nivelSatisfacao', 'EstadoNotificacao'], 'string', 'max' => 50],
            [['contato', 'email', 'canal_id', 'observacao2', 'motivoRecusa', 'observacao3', 'observacao4', 'observacao5', 'observacaoNotificacao'], 'string', 'max' => 100],
            [['observacao', 'informacaoAdicional'], 'string', 'max' => 200],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
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
            'cliente_id' => 'Cliente',
            'clienteNovo' => 'Cliente Novo',
            'FocalPoint' => 'Focal Point',
            'concelho_id' => 'Concelho',
            'contato' => 'Contato',
            'email' => 'Email',
            'canal_id' => 'Canal de contato',
            'data' => 'Data Visita',
            'tipo_id' => 'Tipo',
            'interacoes1' => 'Interações',
            'observacao' => 'Observação',
            'interacoes2' => 'Interação',
            'interacoes3' => 'Interação',
            'interacoes4' => 'Interação',
            'interacoes5' => 'Interação',
            'produtosGCVT' => 'Produtos Gcvt',
            'clienteConcorrencia' => 'Cliente Concorrência',
            'produtoConcorrencia' => 'Produto Concorrência',
            'informacaoAdicional' => 'Informação Adicional',
            'propostaAceite' => 'Proposta Aceite',
            'servicos' => 'Serviços',
            'valorServicoTotal' => 'Valor Serviço Total',
            'valorPrestacao' => 'Valor Prestação',
            'nubCartoesAngariados' => 'Nº Cartões Angariados',
            'observacao2' => 'Observação',
            'motivoRecusa' => 'Motivo Recusa',
            'observacao3' => 'Observação',
            'observacao4' => 'Observação',
            'nivelSatisfacao' => 'Nível Satisfação',
            'razoesinsatisfacao' => 'Razão(ões) da insatisfação',
            'alertas' => 'Alertas',
            'oportunidades' => 'Oportunidades',
            'acoes' => 'Ações',
            'observacao5' => 'Observação',
            'dataNotificacao' => 'Data notificação',
            'EstadoNotificacao' => 'Estado notificação',
            'observacaoNotificacao' => 'Observação de notificação',
            'user_id' => 'Utilizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCedencias()
    {
        return $this->hasMany(Cedencias::className(), ['contato_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCanal()
    {
        return $this->hasOne(Canal::className(), ['id' => 'canal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcelho()
    {
        return $this->hasOne(Concelho::className(), ['id' => 'concelho_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    
    public function getTipo() {
        return $this->hasOne(Tipo::className(), ['id' => 'tipo_id']);
    }
    
}
