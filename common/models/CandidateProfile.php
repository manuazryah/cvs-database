<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "candidate_profile".
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $nationality
 * @property int $current_country
 * @property int $current_city
 * @property string $expected_salary
 * @property int $job_type
 * @property int $gender
 * @property string $dob
 * @property string $photo
 * @property string $job_status
 * @property string $executive_summary
 * @property string $industry
 * @property string $skill
 * @property string $hobbies
 * @property string $extra_curricular_activities
 * @property string $languages_known
 * @property string $driving_licences
 * @property string $title
 * @property string $date_of_updation
 *
 * @property Candidate $candidate
 */
class CandidateProfile extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'candidate_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'nationality', 'name', 'dob', 'gender'], 'required'],
            [['candidate_id', 'nationality', 'current_country', 'job_type', 'gender', 'status'], 'integer'],
            [['candidate_id', 'nationality', 'current_country', 'job_type', 'gender'], 'integer'],
            [['dob', 'date_of_updation', 'industry', 'skill', 'languages_known', 'driving_licences', 'current_city', 'upload_resume'], 'safe'],
            [['executive_summary', 'extra_curricular_activities'], 'string'],
            [['expected_salary', 'photo', 'job_status', 'title'], 'string', 'max' => 100],
            [['hobbies'], 'string', 'max' => 200],
            [['photo'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
            [['candidate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Candidate::className(), 'targetAttribute' => ['candidate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'candidate_id' => 'Candidate ID',
            'nationality' => 'Nationality',
            'current_country' => 'Current Country',
            'current_city' => 'Current City',
            'expected_salary' => 'Expected Salary',
            'job_type' => 'Job Type',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'photo' => 'Photo',
            'job_status' => 'Job Status',
            'executive_summary' => 'Executive Summary',
            'industry' => 'Industry',
            'skill' => 'Skill',
            'hobbies' => 'Hobbies',
            'extra_curricular_activities' => 'Extra Curricular Activities',
            'languages_known' => 'Languages Known',
            'driving_licences' => 'Driving Licences',
            'title' => 'Title',
            'date_of_updation' => 'Date Of Updation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidate() {
        return $this->hasOne(Candidate::className(), ['id' => 'candidate_id']);
    }

}
