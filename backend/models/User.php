<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $role_id
 * @property string $name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $photo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 *
 * @property Adendas[] $adendas
 * @property Cedencias[] $cedencias
 * @property Contatos[] $contatos
 * @property HistoricoEquipamento[] $historicoEquipamentos
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username', 'email', 'profile', 'role_id', 'view_option'], 'required'],
            [['role_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['photo'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Perfil',
            'name' => 'Gestor',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'photo' => 'Foto',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'view_option' => 'Vê Tudo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdendas()
    {
        return $this->hasMany(Adendas::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCedencias()
    {
        return $this->hasMany(Cedencias::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatos()
    {
        return $this->hasMany(Contatos::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricoEquipamentos()
    {
        return $this->hasMany(HistoricoEquipamento::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

     public function getUsers(){
        return \yii\helpers\ArrayHelper::map(self::find()->all(),'id','name');
    }
}
