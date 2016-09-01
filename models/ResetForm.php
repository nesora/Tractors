<?php

namespace app\models;

class ResetForm extends \yii\base\Model {

    public $newpassword;
    public $newpasswordconfirm;
    protected $user = false;
    public $newtoken;

    public function rules() {
        return [
            [['newpassword', 'newpasswordconfirm'], 'required'],
            [['newpassword', 'newpasswordconfirm'], 'string', 'min' => 7, 'max' => 128],
            [['newpasswordconfirm'], 'compare', 'compareAttribute' => 'newpassword', 'message' => 'Passwords do not match , write them again please '],
            [['newpassword', 'newpasswordconfirm'], 'filter', 'filter' => 'trim'],
        ];
    }

    public function attributeLabels() {
        return [
            'newpassword' => 'New Password',
            'newpasswordconfirm' => 'New Password Confirm',
        ];
    }

    public function Reset($user) {
        $user->setAttributes(['token' => NULL, 'expiredate' => NULL, 'password' => $this->newpassword]);
        return $user->save();
    }

}
