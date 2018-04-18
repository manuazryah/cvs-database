<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

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
class Candidate extends ActiveRecord implements IdentityInterface {

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
                [['email', 'user_name', 'password', 'password_repeat', 'phone'], 'required', 'on' => 'create'],
                [['email', 'user_name', 'password', 'address', 'phone'], 'required', 'on' => 'create-admin'],
                [['email', 'user_name', 'phone', 'address'], 'required', 'on' => 'update'],
                [['email', 'user_name', 'phone', 'address'], 'required', 'on' => 'update-admin'],
                [['email'], 'unique', 'on' => 'update'],
                [['email'], 'unique', 'on' => 'create-admin'],
                [['email'], 'unique', 'on' => 'update-admin'],
                [['status', 'email_varification_status', 'review_status'], 'integer'],
                [['date_of_creation', 'date_of_updation', 'phone', 'address', 'alternate_phone', 'alternate_address'], 'safe'],
                [['email', 'user_name', 'password', 'user_id', 'facebook_link', 'linked_in_link', 'google_link', 'youtube_link'], 'string', 'max' => 100],
                ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match", 'on' => 'create'],
                [['user_name', 'password'], 'required', 'on' => 'login'],
                [['password'], 'validatePassword', 'on' => 'login'],
        ];
    }

    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Incorrect username or password.');
            } elseif ($user->email_varification_status != 1) {
                $this->addError($attribute, 'Your email id is not varified. Please check your mail.');
            } elseif (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            } else {
                Yii::$app->session['candidate'] = $user->attributes;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'user_name' => 'Name',
            'password' => 'Password',
            'user_id' => 'User ID',
            'status' => 'Status',
            'phone' => 'Phone',
            'address' => 'Address',
            'alternate_phone' => 'Alternate Phone (optional)',
            'alternate_address' => 'Alternate Address (optional)',
            'date_of_creation' => 'Date Of Creation',
            'date_of_updation' => 'Date Of Updation',
            'email_varification_status' => 'Email Varification Status',
            'linked_in_link' => 'Linked in Link',
            'facebook_link' => 'Facebook Link',
            'youtube_link' => 'Youtube Link',
            'google_link' => 'Google Link',
            'review_status' => 'Review Status',
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
            $this->_user = static::find()->where('email = :uname and status = :stat', ['uname' => $this->user_name, 'stat' => '1'])->one();
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
        return static::findOne(['user_name' => $username, 'status' => 1]);
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
