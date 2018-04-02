<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "candidate".
 *
 * @property int $id
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property string $user_id
 * @property int $status
 * @property string $date_of_creation
 * @property string $date_of_updation
 * @property int $email_varification_status
 */
class CandidateRegister extends \yii\db\ActiveRecord {

    public $password_repeat;
    private $_user;
    public $rememberMe = true;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'candidate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['email', 'user_name', 'password', 'password_repeat'], 'required'],
                [['status', 'email_varification_status'], 'integer'],
                [['date_of_creation', 'date_of_updation'], 'safe'],
                [['email', 'user_name', 'password', 'user_id'], 'string', 'max' => 100],
                ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'user_name' => 'User Name',
            'password' => 'Password',
            'user_id' => 'User ID',
            'status' => 'Status',
            'date_of_creation' => 'Date Of Creation',
            'date_of_updation' => 'Date Of Updation',
            'email_varification_status' => 'Email Varification Status',
        ];
    }

}
