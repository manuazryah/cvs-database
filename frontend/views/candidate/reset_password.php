<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-lg-12">
                    <aside  id="target" class="aside">
                        <h4 class="title">My Account</h4>
                        <ul>
                            <li><?= Html::a('User Details', ['/candidate/index']) ?></li>
                            <li><?= Html::a('Profile Edit', ['/candidate/update-profile']) ?></li>
                            <li><?= Html::a('CV View', ['/candidate/online-curriculum-vitae']) ?></li>
                            <li class="active"><?= Html::a('Reset Password', ['/candidate/reset-password']) ?></li>
                        </ul>
                    </aside>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-12">
                    <div class="rightside-box">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php
                        $form = ActiveForm::begin([
                                    'options' => [
                                        'class' => 'panel-body register-form pb0'
                                    ]
                                        ]
                        );
                        ?>
                        <div class="p_b30">
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
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-larger btn-block submit']) ?>
                                <?php // Html::a('Reset', ['reset-password'], ['class' => 'btn btn-large btn-default']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
