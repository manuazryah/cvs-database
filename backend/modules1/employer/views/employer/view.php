<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employer */

$this->title = 'Employer details';
$this->params['breadcrumbs'][] = ['label' => 'Employers', 'url' => ['index']];
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
                <?= Html::a('<i class="fa fa-edit"></i><span> Update</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-lock"></i><span> Reset Password</span>', ['reset-password', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-folder-open-o"></i><span> Shortlist Folders</span>', ['shortlist-folders', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="employer-view">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//                                'id',
                                'first_name',
                                'last_name',
                                'email:email',
                                'phone',
//                                'password',
                                'company_name',
                                    [
                                    'attribute' => 'country',
                                    'value' => function ($model) {
                                        return $model->country == '' ? '' : \common\models\Country::findOne($model->country)->country_name;
                                    },
                                ],
                                'location',
                                'address:ntext',
                                'company_email:email',
                                'company_phone_number',
                                'position',
//                                'email_varification:email',
//                                'status',
//                                'DOC',
//                                'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


