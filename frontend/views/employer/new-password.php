<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="forgot-password-sec">
    <div class="dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div id="form" class="">
                <div class="bg-forgot">
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="active"><a href="#forgot" role="tab" data-toggle="tab" aria-expanded="true">Forgot Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="forgot">
                                <?= \common\widgets\Alert::widget(); ?>
                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <div class="form-group">
                                    <div class="form-group field-employee-password">
                                        <label class="control-label" for="new-password">New Password</label>
                                        <input type="password" id="new-password" class="form-control" name="new-password" autofocus="false" required>
                                        <p class="help-block help-block-error"></p>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="form-group field-employee-password">
                                        <label class="control-label" for="confirm-password">Confirm Password</label>
                                        <input type="password" id="confirm-password" class="form-control" name="confirm-password" autofocus="false" required>
                                        <p class="help-block help-block-error"></p>
                                    </div>

                                </div>
                                <div style="position: relative;">
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                                </div>
                                <div class="clearfix"></div>
                                <?php ActiveForm::end(); ?>                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>