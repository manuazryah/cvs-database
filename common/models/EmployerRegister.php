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
class EmployerRegister extends \yii\db\ActiveRecord {

    public $password_repeat;
    private $_user;
    public $rememberMe = true;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'employer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['first_name', 'email', 'password', 'password_repeat', 'location'], 'required'],
                [['country', 'status','review_status'], 'integer'],
                [['address'], 'string'],
                [['DOC', 'DOU', 'email_varification','description'], 'safe'],
                [['first_name', 'email', 'password', 'company_name', 'location', 'company_email', 'position'], 'string', 'max' => 100],
                [['phone', 'company_phone_number'], 'string', 'max' => 20],
                [['email'], 'unique'],
                [['email', 'company_email'], 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

   /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'company_name' => 'Company Name',
            'country' => 'Country',
            'location' => 'Location',
            'address' => 'Address',
            'description' => 'Description (About your company)',
            'company_email' => 'Company Email',
            'company_phone_number' => 'Company Phone Number',
            'position' => 'Position',
            'status' => 'Status',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}