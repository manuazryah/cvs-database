<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page_banner banner employer-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="banner-heading">User Details</div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="Resume">
                        <h1>My Account</h1>
                        <ul class="unstyled">
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  My Profile', ['index']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Edit Profile', ['update-profile']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Online CV', ['online-curriculum-vitae']) ?>
                            </li>
                            <li class="active">
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Reset Password', ['reset-password']) ?>
                            </li>
                            <?php
                            echo '<li class="border-none">'
                            . Html::beginForm(['/candidate/logout'], 'post', ['style' => '']) . '<a><i class="fa fa-caret-right"></i>'
                            . Html::submitButton(
                                    'Sign out', ['class' => '', 'style' => 'background: white;border: none;']
                            ) . '</a>'
                            . Html::endForm()
                            . '</li>';
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="job_title">Reset Your <span class="color">Password</span></div>
                    <div class="profile-login-bg">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php
                        $form = ActiveForm::begin();
                        ?>
                        <div class="row p_b30">
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($model, 'password')->passwordInput()->label('Old Password *') ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($model, 'new_password')->passwordInput()->label('new_password *') ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($model, 'confirm_password')->passwordInput()->label('confirm_password *') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-large btn-default']) ?>
                            <?= Html::a('Reset', ['reset-password'], ['class' => 'btn btn-large btn-default']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



