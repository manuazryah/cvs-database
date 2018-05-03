<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "candidate_education".
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $course_name
 * @property string $collage_university
 * @property int $country
 * @property string $from_year
 * @property string $to_year
 * @property string $date_of_updation
 *
 * @property Candidate $candidate
 */
class CandidateEducation extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'candidate_education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['candidate_id', 'qualification', 'country','highest_qualification'], 'integer'],
            [['from_year', 'to_year', 'date_of_updation'], 'safe'],
            [['collage_university', 'course_name'], 'string', 'max' => 100],
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
            'course_name' => 'Course Name',
            'qualification' => 'Qualification',
            'collage_university' => 'Collage University',
            'country' => 'Country',
            'from_year' => 'From Year',
            'to_year' => 'To Year',
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
