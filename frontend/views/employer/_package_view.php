<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
?>
<div class="col-md-3">
    <div class="pack-box">
        <h3>
            <?= $model->package_name ?>
        </h3>
        <?= Html::a('SELECT', ['select-plan', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id)], ['class' => 'btn btn-lg btn-primary']) ?>
        <ul>
            <li>Package Price : <?= $model->package_price ?></li>
            <li>Number of Days : <?= $model->no_of_days ?></li>
            <li>Number of Downloads : <?= $model->no_of_downloads ?></li>
        </ul>
    </div>
</div>

