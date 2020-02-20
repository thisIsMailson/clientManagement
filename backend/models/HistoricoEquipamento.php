<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "historico_equipamento".
 *
 * @property string $id
 * @property string $data_alteracao
 * @property string $equipamento_id
 * @property string $utilizador_id
 * @property int $user_id
 *
 * @property Equipamentos $equipamento
 * @property User $user
 */
class HistoricoEquipamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico_equipamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_alteracao'], 'safe'],
            [['equipamento_id', 'utilizador_id', 'user_id'], 'required'],
            [['equipamento_id', 'utilizador_id', 'user_id'], 'integer'],
            [['equipamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamentos::className(), 'targetAttribute' => ['equipamento_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_alteracao' => 'Data Alteração',
            'equipamento_id' => 'Equipamento ID',
            'utilizador_id' => 'Utilizador ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamentos::className(), ['id' => 'equipamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
