<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $tipo
 * @property string $descricao
 * @property string $estado_perfil
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'descricao', 'estado_perfil'], 'required'],
            [['tipo', 'descricao'], 'string', 'max' => 100],
            [['estado_perfil'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'descricao' => 'Descrição',
            'estado_perfil' => 'Estado Perfil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
}
