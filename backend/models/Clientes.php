<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property string $id
 * @property string $cod_cliente
 * @property string $nome
 * @property string $estado
 * @property string $tipo_cliente
 * @property string $gestor
 * @property string $cod_gp
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Contatos[] $contatos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_cliente', 'nome', 'estado', 'tipo_cliente', 'gestor'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['cod_cliente', 'nome', 'estado', 'gestor', 'cod_gp'], 'string', 'max' => 255],
            [['tipo_cliente'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_cliente' => 'Código Siebel',
            'nome' => 'Nome do Cliente',
            'estado' => 'Estado',
            'tipo_cliente' => 'Tipo Cliente',
            'gestor' => 'Gestor',
            'cod_gp' => 'NIF',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getClientes(){
        return \yii\helpers\ArrayHelper::map(self::find()->all(),'id','nome');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatos()
    {
        return $this->hasMany(Contatos::className(), ['cliente_id' => 'id']);
    }
}
