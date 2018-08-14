<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-2 col-lg-12">
                    <aside  id="target" class="aside">
                        <h4 class="title">My Account</h4>
                        <ul>
                            <li class="active"><?= Html::a('User Details', ['/candidate/index']) ?></li>
                            <li><?= Html::a('Profile Edit', ['/candidate/update-profile']) ?></li>
                            <li><?= Html::a('CV View', ['/candidate/online-curriculum-vitae']) ?></li>
                            <li><?= Html::a('Reset Password', ['/candidate/reset-password']) ?></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-lg-12">
                    <div class="rightside-box">
                        <?= \common\widgets\Alert::widget(); ?>
                        <?php
                        $form = ActiveForm::begin();
                        ?>
                        <div class="form-group col-md-6 p-l">
                            <?= $form->field($model, 'user_name')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <?= $form->field($model, 'email')->textInput(['readonly'=>TRUE]) ?>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <?= $form->field($model, 'phone')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <?= $form->field($model, 'alternate_phone')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <?= $form->field($model, 'facebook_link')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <?= $form->field($model, 'linked_in_link')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <?= $form->field($model, 'google_link')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <?= $form->field($model, 'youtube_link')->textInput() ?>
                        </div>
                        <div class="form-group col-md-12 p-l p-r">
                            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
                        </div>
                        <div class="clearfix"></div>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-larger btn-block submit ']) ?>
                        <?php ActiveForm::end(); ?>
                          <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



