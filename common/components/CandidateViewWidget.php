<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppointmentWidget
 *
 * @author
 * JIthin Wails
 */

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\CandidateProfile;

class CandidateViewWidget extends Widget {

    public $id;

    public function init() {
        parent::init();
        if ($this->id === null) {
            throw new \yii\web\HttpException(404, 'Invalid Purchase Order.Eroor Code:1007');
        }
    }

    public function run() {
        $model = CandidateProfile::findOne($this->id);
        $profile_info = \common\models\Candidate::find()->where(['id' => $model->candidate_id])->one();
        return $this->render('candidate_view', [
                    'model' => $model,
                    'profile_info' => $profile_info,
        ]);
        //return Html::encode($this->message);
    }

}

?>
