<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CvSearch extends Model {

    public $keyword;
    public $location;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['keyword', 'location'], 'safe'],
        ];
    }

}
