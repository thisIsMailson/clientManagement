<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adenda_equipamentos".
 *
 * @property int $id
 * @property int $equipamento_id
 * @property int $adenda_id
 * @property int $quantidade
 * @property float $preco
 * @property int $PrecoTotal
 *
 * @property Equipamentos $equipamento
 */
class AdendaEquipamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adenda_equipamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipamento_id', 'adenda_id', 'quantidade', 'preco', 'PrecoTotal'], 'required'],
            [['equipamento_id', 'adenda_id', 'quantidade', 'PrecoTotal'], 'integer'],
            [['preco'], 'number'],
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
            'adenda_id' => 'Adenda',
            'quantidade' => 'Quantidade',
            'preco' => 'Preço',
            'PrecoTotal' => 'Preço Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamentos::className(), ['id' => 'equipamento_id']);
    }
    public function getAdenda()
    {
        return $this->hasOne(Adenda::className(), ['id' => 'adenda_id']);
    }
}
