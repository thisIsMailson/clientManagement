<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "metas".
 *
 * @property int $id
 * @property string $mes
 * @property int $meta
 */
class Metas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'meta'], 'required'],
            [['data'], 'safe'],
            [['meta'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'meta' => 'Meta',
        ];
    }
}
