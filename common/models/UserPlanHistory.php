<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_plan_history".
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan
 * @property string $start_date
 * @property string $end_date
 */
class UserPlanHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_plan_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'plan'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'plan' => 'Plan',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }
}
