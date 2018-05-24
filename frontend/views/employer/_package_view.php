<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div class="col-md-3">
    <div class="">
        <div class="panel-pricing">
            <div class="panel-heading">
                <i class="fa fa-pagelines"></i>
                <h3><?= $model->package_name ?></h3>
            </div>
            <div class="card-header">
                <h3 class="display-2"><span class="currency">$</span><?= $model->package_price ?><span class="period">/month</span></h3>
            </div>
            <ul class="list-group text-center">
                <li class="list-group-item"> <?= $model->no_of_days ?> Day Expired</li>
                <li class="list-group-item"> <?= $model->no_of_downloads ?> Downloads</li>
            </ul>
            <div class="panel-footer">
                <?= Html::a('SELECT', ['select-plan', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id)], ['class' => 'btn btn-lg btn-default']) ?>
            </div>
        </div>
    </div>
</div>

