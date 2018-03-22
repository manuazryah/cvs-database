<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employer".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $company_name
 * @property int $country
 * @property string $location
 * @property string $address
 * @property string $company_email
 * @property string $company_phone_number
 * @property string $position
 * @property int $status
 * @property string $DOC
 * @property string $DOU
 */class Employer extends ActiveRecord implements IdentityInterface {

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
            [['first_name', 'last_name', 'email', 'password'], 'required', 'on' => 'create'],
            [['first_name', 'last_name', 'email', 'password'], 'required', 'on' => 'update'],
            [['country', 'status'], 'integer'],
            [['address'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'company_name', 'location', 'company_email', 'position'], 'string', 'max' => 100],
            [['phone', 'company_phone_number'], 'string', 'max' => 20],
            [['email'], 'unique', 'on' => 'create'],
            [['email'], 'unique', 'on' => 'update'],
            [['email', 'company_email'], 'email'],
            [['email', 'password'], 'required', 'on' => 'login'],
            [['password'], 'validatePassword', 'on' => 'login'],
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            } else {
                Yii::$app->session['user_data'] = $user->attributes;
            }
        }
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
            'company_email' => 'Company Email',
            'company_phone_number' => 'Company Phone Number',
            'position' => 'Position',
            'status' => 'Status',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
        } else {
            return false;
        }
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = static::find()->where(['email' => $this->email, 'status' => '1'])->one();
        }

        return $this->_user;
    }

    public function validatedata($data) {
        if ($data == '') {
            $this->addError('password', 'Incorrect username or password');
            return true;
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['email' => $username, 'status' => 1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

}
