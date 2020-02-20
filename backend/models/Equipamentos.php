<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "equipamentos".
 *
 * @property int $id
 * @property string $nome
 * @property string $marca
 * @property float $preco
 * @property string $estado_equipamento
 *
 * @property AdendaEquipamentos[] $adendaEquipamentos
 * @property CedenciaEquipamentos[] $cedenciaEquipamentos
 * @property HistoricoEquipamento[] $historicoEquipamentos
 */
class Equipamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'marca', 'preco', 'estado_equipamento'], 'required'],
            [['preco'], 'number'],
            [['nome', 'marca'], 'string', 'max' => 100],
            [['estado_equipamento'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'marca' => 'Marca',
            'preco' => 'Preçoo',
            'estado_equipamento' => 'Estado Equipamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdendaEquipamentos()
    {
        return $this->hasMany(AdendaEquipamentos::className(), ['equipamento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCedenciaEquipamentos()
    {
        return $this->hasMany(CedenciaEquipamentos::className(), ['equipamento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoEquipamentos()
    {
        return $this->hasMany(HistoricoEquipamento::className(), ['equipamento_id' => 'id']);
    }
}
