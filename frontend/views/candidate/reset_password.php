<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="page_banner banner employer-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="banner-heading">Reset Password</div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <?= \common\widgets\Alert::widget(); ?>
                    <?php
                    $form = ActiveForm::begin();
                    ?>
                    <div class="row p_b30">
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model, 'password')->passwordInput()->label('Old Password *') ?>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model, 'new_password')->passwordInput()->label('New Password *') ?>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <?= $form->field($model, 'confirm_password')->passwordInput()->label('Confirm Password *') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-large btn-submit']) ?>
                        <?php // Html::a('Reset', ['reset-password'], ['class' => 'btn btn-large btn-default']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
</main>
