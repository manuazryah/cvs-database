<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangePassword extends Model {

    public $password;
    public $new_password;
    public $confirm_password;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['password', 'new_password', 'confirm_password'], 'required'],
            ['password', 'validatePassword'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => "Passwords don't match"],
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!Yii::$app->getSecurity()->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect old password.');
            } else {
                $user->password = Yii::$app->security->generatePasswordHash($this->confirm_password);
                $user->update();
                return $user;
            }
        }
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = AdminUsers::find()->where(['id' => Yii::$app->user->identity->id])->one();
        }
        return $this->_user;
    }

}
