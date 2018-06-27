<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employer_notes".
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $employer_id
 * @property string $note
 * @property string $DOU
 */
class EmployerNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employer_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['candidate_id', 'employer_id'], 'integer'],
            [['note'], 'string'],
            [['DOU'], 'safe'],
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
            'note' => 'Note',
            'DOU' => 'Dou',
        ];
    }
}
