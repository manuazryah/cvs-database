<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Employer</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-edit"></i><span> Update</span>', ['update', 'id' => $employer->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-folder-open-o"></i><span> Shortlist Folders</span>', ['shortlist-folders', 'id' => $employer->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body">
                    <div class="candidate-create">
                        <div class="candidate-form form-inline">
                            <?= \common\widgets\Alert::widget() ?>
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                    <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                    <?= $form->field($model, 'confirm_password')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                    <div class="form-group">
                                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'style' => 'margin-top: 35px;']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>