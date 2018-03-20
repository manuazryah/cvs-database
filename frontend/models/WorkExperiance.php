<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_experiance".
 *
 * @property int $id
 * @property int $candidate_id
 * @property string $company_name
 * @property string $designation
 * @property string $from_date
 * @property string $to_date
 * @property string $job_responsibility
 * @property string $date_of_updation
 *
 * @property Candidate $candidate
 */
class WorkExperiance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_experiance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['candidate_id'], 'integer'],
            [['from_date', 'to_date', 'date_of_updation'], 'safe'],
            [['job_responsibility'], 'string'],
            [['company_name', 'designation'], 'string', 'max' => 100],
            [['candidate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Candidate::className(), 'targetAttribute' => ['candidate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'candidate_id' => 'Candidate ID',
            'company_name' => 'Company Name',
            'designation' => 'Designation',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'job_responsibility' => 'Job Responsibility',
            'date_of_updation' => 'Date Of Updation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidate()
    {
        return $this->hasOne(Candidate::className(), ['id' => 'candidate_id']);
    }
}
