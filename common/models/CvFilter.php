<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CvFilter extends Model {

    public $industries;
    public $skills;
    public $job_types;
    public $keyword;
    public $location;
    public $salary_range;
    public $gender;
    public $language;
    public $job_status;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['industries', 'skills', 'job_types', 'keyword', 'location', 'salary_range', 'gender', 'language', 'job_status'], 'safe'],
        ];
    }

}
