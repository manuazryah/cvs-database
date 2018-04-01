<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "short_list".
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $employer_id
 * @property string $folder_name
 * @property string $short_list_date
 * @property int $status
 */
class ShortList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['candidate_id', 'employer_id', 'status'], 'integer'],
            [['short_list_date'], 'safe'],
            [['folder_name'], 'string', 'max' => 100],
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
            'employer_id' => 'Employer ID',
            'folder_name' => 'Folder Name',
            'short_list_date' => 'Short List Date',
            'status' => 'Status',
        ];
    }
}
