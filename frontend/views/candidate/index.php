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
                <div class="col-md-12">
                    <?php
                    $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'panel-body user-details-form'
                                ]
                    ]);
                    ?>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'user_name')->textInput() ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?= $form->field($model, 'email')->textInput() ?>
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
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'alternate_address')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="clearfix"></div>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-submit']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
</main>



