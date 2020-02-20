<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $contato_id
 * @property int $user_id
 * @property string $data
 * @property string $observação
 *
 * @property Contatos $contato
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'observacao'], 'required'],
            [['contato_id', 'user_id', 'gestor_id'], 'integer'],
            [['data', 'alvo'], 'safe'],
            [['observacao'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'gestor_id' => 'Gestor',
            'contato_id' => 'Nº Contato',
            'user_id' => 'Utilizador',
            'data' => 'Data',
            'observacao' => 'Observação',
            'alvo'=>'Para todos',
        ];
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
