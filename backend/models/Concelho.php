<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "concelho".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Contatos[] $contatos
 */
class Concelho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'concelho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Concelho',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatos()
    {
        return $this->hasMany(Contatos::className(), ['concelho_id' => 'id']);
    }
}
