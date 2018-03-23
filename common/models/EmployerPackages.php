<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employer_packages".
 *
 * @property int $id
 * @property int $employer_id
 * @property int $package
 * @property string $start_date
 * @property string $end_date
 * @property int $no_of_days
 * @property int $no_of_days_left
 * @property int $no_of_views
 * @property int $no_of_views_left
 * @property string $created_date
 * @property string $updated_date
 */
class EmployerPackages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employer_packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'package'], 'required'],
            [['employer_id', 'package', 'no_of_days', 'no_of_days_left', 'no_of_views', 'no_of_views_left'], 'integer'],
            [['start_date', 'end_date', 'created_date', 'updated_date'], 'safe'],
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
            'package' => 'Package',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'no_of_days' => 'No Of Days',
            'no_of_days_left' => 'No Of Days Left',
            'no_of_views' => 'No Of Views',
            'no_of_views_left' => 'No Of Views Left',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
