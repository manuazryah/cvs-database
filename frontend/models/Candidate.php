<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "candidate".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $user_name
 * @property string $password
 * @property int $gender
 * @property string $dob
 * @property int $nationality
 * @property int $current_country
 * @property string $current_city
 * @property string $address
 * @property string $position
 * @property string $position_looking_for
 * @property string $sub_position
 * @property string $qualification
 * @property string $skill_set
 * @property int $year_of experience
 * @property string $upload_cv
 * @property int $status
 * @property string $date_of_creation
 * @property string $date_of_updation
 * @property int $email_varification_status
 */
class Candidate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'candidate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender', 'nationality', 'current_country', 'year_of experience', 'status', 'email_varification_status'], 'integer'],
            [['dob', 'date_of_creation', 'date_of_updation'], 'safe'],
            [['address'], 'string'],
            [['first_name', 'last_name', 'email', 'user_name', 'password', 'current_city', 'position', 'position_looking_for', 'sub_position', 'qualification', 'skill_set', 'upload_cv'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'user_name' => 'User Name',
            'password' => 'Password',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'nationality' => 'Nationality',
            'current_country' => 'Current Country',
            'current_city' => 'Current City',
            'address' => 'Address',
            'position' => 'Position',
            'position_looking_for' => 'Position Looking For',
            'sub_position' => 'Sub Position',
            'qualification' => 'Qualification',
            'skill_set' => 'Skill Set',
            'year_of experience' => 'Year Of Experience',
            'upload_cv' => 'Upload Cv',
            'status' => 'Status',
            'date_of_creation' => 'Date Of Creation',
            'date_of_updation' => 'Date Of Updation',
            'email_varification_status' => 'Email Varification Status',
        ];
    }
}
