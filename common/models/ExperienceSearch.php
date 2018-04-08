<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "experience_search".
 *
 * @property int $id
 * @property string $experience_search
 * @property int $status
 */
class ExperienceSearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experience_search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['experience_search'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'experience_search' => 'Experience Search',
            'status' => 'Status',
        ];
    }
}
