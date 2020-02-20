<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "canal".
 *
 * @property int $id
 * @property string $canal
 */
class Canal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public static function tableName()
    {
        return 'canal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['canal'], 'required'],
            [['canal'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'canal' => 'Canal',
        ];
    }
}
