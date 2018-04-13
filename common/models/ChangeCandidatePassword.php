<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangeCandidatePassword extends Model {

    public $new_password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['new_password', 'confirm_password'], 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => "Passwords don't match"],
        ];
    }

}
