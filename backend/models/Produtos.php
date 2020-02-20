<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "produtos".
 *
 * @property int $id
 * @property string $nome
 * @property string $estado_produto
 */
class Produtos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produtos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'estado_produto'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['estado_produto'], 'string', 'max' => 20],
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
            'estado_produto' => 'Estado Produto',
        ];
    }

    public function getProducts(){
        return \yii\helpers\ArrayHelper::map(self::find()->all(),'id','nome');
    }
}
