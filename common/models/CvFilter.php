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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['industries', 'skills', 'job_types', 'keyword', 'location'], 'safe'],
        ];
    }

}
