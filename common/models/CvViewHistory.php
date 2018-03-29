<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cv_view_history".
 *
 * @property int $id
 * @property int $employer_id
 * @property int $candidate_id
 * @property string $date_of_view
 */
class CvViewHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv_view_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'candidate_id'], 'integer'],
            [['date_of_view'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer_id' => 'Employer ID',
            'candidate_id' => 'Candidate ID',
            'date_of_view' => 'Date Of View',
        ];
    }
}
