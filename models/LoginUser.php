<?php

namespace app\models;

/**
 * This is the model class for table "loginuser".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $token
 * @property string $newpassword
 * @property string $newpasswordconfirm
 */
class LoginUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $newpassword;
    public $newpasswordconfirm;
    public $hash;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'loginuser';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email', 'password', 'firstname', 'lastname'], 'required'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 7, 'max' => 128],
            [['email'], 'string', 'max' => 120],
            ['expiredate', 'integer'],
            [['password', 'firstname', 'lastname'], 'string', 'max' => 56],
            [['token'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'email' => 'Email address',
            'password' => 'Password',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'token' => 'Token',
            'expiredate' => 'Expire Date',
        ];
    }

    public function getId() {
        return $this->id;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findByEmail($username) {
        return self::findOne(['email' => $username]);
    }

    public function setPassword($password) {
      
        $this->password = Yii::$app->security->generatePasswordHash($password);
        
    }

    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

}
