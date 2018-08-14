<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = 'Change Password';
?>
<div class="admin-users-index package-details">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="employee-create">
                            <?= \common\widgets\Alert::widget(); ?>
                            <?php
                            $form = ActiveForm::begin();
                            ?>
                            <div class="row">
                                <div class="form-group col-md-4 p-l">
                                    <?= $form->field($model, 'password')->passwordInput()->label('Old Password *') ?>
                                </div>
                                <div class="form-group col-md-4 p-l">
                                    <?= $form->field($model, 'new_password')->passwordInput()->label('New Password *') ?>
                                </div>
                                <div class="form-group col-md-4 p-l">
                                    <?= $form->field($model, 'confirm_password')->passwordInput()->label('Confirm Password *') ?>
                                </div>
                                <div class="form-group col-md-12 p-l">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>