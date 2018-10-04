<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CvFilter extends Model {

    public $industries;
    public $industries1;
    public $skills;
    public $skills1;
    public $job_types;
    public $job_types1;
    public $keyword;
    public $location;
    public $salary_range;
    public $gender;
    public $language;
    public $job_status;
    public $cv_folder;
    public $nationality;
    public $experience;
    public $folder_name;
    public $review_status;
    public $salary_range1;
    public $gender1;
    public $language1;
    public $job_status1;
    public $cv_folder1;
    public $nationality1;
    public $experience1;
    public $folder_name1;
    public $review_status1;
    public $industry;
    public $skill;
    public $loc;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['industries', 'industries1', 'skills', 'skills1', 'job_types', 'job_types1', 'keyword', 'location', 'salary_range', 'gender', 'language', 'job_status', 'cv_folder', 'nationality', 'experience', 'folder_name', 'review_status', 'industry', 'skill', 'loc', 'salary_range1', 'gender1', 'language1', 'job_status1', 'cv_folder1', 'nationality1', 'experience1', 'folder_name1', 'review_status1'], 'safe'],
        ];
    }

}
