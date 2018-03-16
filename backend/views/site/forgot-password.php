<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Forgot Password';
?>
<div class="login-container">

    <div class="row">

        <div class="col-sm-6 log-frm">

            <script type="text/javascript">
                jQuery(document).ready(function ($)
                {
                    setTimeout(function () {
                        $(".fade-in-effect").addClass('in');
                    }, 1);

                });
            </script>
            <!-- Errors container -->
            <div class="errors-container">
            </div>

            <div class="forgot-header">
                <img width="150" height="" src="<?= Yii::$app->homeUrl ?>images/logo.png"/>
                <h4>Forgot Your Password ?</h4>
                <hr/>
                <h5>Let us help you</h5>
                <p>Type your username / email ID in the field below to receive your validation code by email:</p>
            </div>

            <!-- Add class "fade-in-effect" for login form effect -->
            <?php
            $form = ActiveForm::begin(
                            [
                                'id' => 'forgot-email',
                                'method' => 'post',
                                'options' => [
                                    'class' => 'login-form fade-in-effect'
                                ]
                            ]
            );
            ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <h2></h2>
            <label class="control-label" for="employee-user_name" style="color: white;
                   font-size: 14px;
                   font-weight: bold;">Email/Username</label>
            <div class="form-group">
                <?= $form->field($model, 'user_name')->textInput(['class' => 'form-control']) ?>
            </div>
            <!--            <label class="control-label" for="employee-user_name" style="color: white;
                               font-size: 14px;
                               font-weight: bold;">Email/Username</label>
                        <div class="form-group">
                            <label class="control-label" for="employee-user_name">Email/Username</label>
                            <div class="form-group field-employee-user_name">
                                <label class="control-label" for="employee-user_name">Email/Username</label>
                                <input type="text" id="user_name" class="form-control" name="user_name" autofocus="true">
                                <p class="help-block help-block-error"></p>
                            </div>

                        </div>-->


            <div class="form-group" style="float: right;">
                <button type="submit" class="btn btn-primary" style="margin-top: 18px;border: 1px solid rgba(255, 255, 255, 0.43);">Submit</button>    </div>
                <?php ActiveForm::end(); ?>


        </div>

    </div>

</div>
