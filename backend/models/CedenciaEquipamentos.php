<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cedencia_equipamentos".
 *
 * @property int $id
 * @property int $equipamento_id
 * @property int $cedencia_id
 * @property int $quantidade
 * @property float $preco
 * @property int $PrecoTotal
 *
 * @property Cedencias $cedencia
 * @property Equipamentos $equipamento
 */
class CedenciaEquipamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cedencia_equipamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipamento_id', 'cedencia_id', 'quantidade', 'preco', 'PrecoTotal'], 'required'],
            [['equipamento_id', 'cedencia_id', 'quantidade', 'PrecoTotal'], 'integer'],
            [['preco'], 'number'],
            [['cedencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cedencias::className(), 'targetAttribute' => ['cedencia_id' => 'id']],
            [['equipamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipamentos::className(), 'targetAttribute' => ['equipamento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipamento_id' => 'Equipamento',
            'cedencia_id' => 'Cedência',
            'quantidade' => 'Quantidade',
            'preco' => 'Preço',
            'PrecoTotal' => 'Preço Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCedencia()
    {
        return $this->hasOne(Cedencias::className(), ['id' => 'cedencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamentos::className(), ['id' => 'equipamento_id']);
    }
}
