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
use common\models\PurchaseOrderMst;

class PurchaseOrderWidget extends Widget {

    public $id;

    public function init() {
        parent::init();
        if ($this->id === null) {
            throw new \yii\web\HttpException(404, 'Invalid Purchase Order.Eroor Code:1007');
        }
    }

    public function run() {
        $Order = PurchaseOrderMst::findOne($this->id);
        return $this->render('purchase_order', ['Order' => $Order]);
        //return Html::encode($this->message);
    }

}

?>
