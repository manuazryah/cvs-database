<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployerReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body table-responsive">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Employer</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?= Html::a('<i class="fa fa-file-excel-o"></i><span> Export to Excel</span>', ['exports'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            'first_name',
                            'last_name',
                            'email:email',
                            [
                                'attribute' => 'phone',
                                'value' => function ($model) {
                                    return $model->phone == '' ? '' : $model->phone;
                                },
                            ],
//                                [
//                                'attribute' => 'company_name',
//                                'value' => function ($model) {
//                                    return $model->company_name == '' ? '' : $model->company_name;
//                                },
//                            ],
                            // 'country',
                            // 'location',
                            // 'address:ntext',
                            // 'company_email:email',
                            // 'company_phone_number',
                            // 'position',
                            // 'email_varification:email',
                            [
                                'attribute' => 'review_status',
                                'format' => 'raw',
                                'filter' => [1 => 'Reviewed', 0 => 'Unreviewed'],
                                'value' => function ($model) {
                                    return $model->review_status == 1 ? 'Reviewed' : 'Unreviewed';
                                },
                            ],
                            [
                                'attribute' => 'last_login',
                                'value' => function ($model) {
                                    return $model->last_login != '' ? $model->last_login : '';
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}{view}{update}',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


