<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = 'Update Jobseeker Profile';
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                <div class="col-xs-12">
                </div>
            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Jobseekers</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-pencil"></i><span> Contact Details</span>', ['update', 'id' => $user->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-eye"></i><span> View Profile</span>', ['view', 'id' => $user->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-ban"></i><span> Disable Profile</span>', ['disable-profile', 'id' => $user->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-lock"></i><span> Reset Password</span>', ['reset-password', 'id' => $user->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="clearfix"></div>
                <div class="panel-body"><div class="candidate-create">
                        <?=
                        $this->render('_form_profile', [
                            'model' => $model,
                            'model_education' => $model_education,
                            'model_experience' => $model_experience,
                            'user' => $user,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
