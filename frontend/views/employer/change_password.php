<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password';
?>
<div class="admin-users-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                <span><strong>For Support Contact Us: </strong><ul><li><a href="tel:+971 50 4752515"><i class="fa fa-phone"></i> +971 50 4752515</a></li><li><a href="mailto:info@cvs.ae"><i class="fa fa-envelope-o"></i> info@cvs.ae</a></li></ul></span>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="col-md-3">
                            <div class="employee-create">
                                <?= \common\widgets\Alert::widget(); ?>
                                <?php
                                $form = ActiveForm::begin();
                                ?>
                                <div class="row">
                                    <div class="col-md-12 col-sm-4 col-xs-12">
                                        <?= $form->field($model, 'password')->passwordInput()->label('Old Password *') ?>
                                    </div>
                                    <div class="col-md-12 col-sm-4 col-xs-12">
                                        <?= $form->field($model, 'new_password')->passwordInput()->label('New Password *') ?>
                                    </div>
                                    <div class="col-md-12 col-sm-4 col-xs-12">
                                        <?= $form->field($model, 'confirm_password')->passwordInput()->label('Confirm Password *') ?>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                                    <?= Html::a('Reset', ['change-password'], ['class' => 'btn btn-success btn-reset']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear-fix"></div>