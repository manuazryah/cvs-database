<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body table-responsive">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Candidate</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            'user_name',
                            'email:email',
//                            'password',
                            'user_id',
                            'phone',
                            'address:ntext',
                            // 'alternate_phone',
                            // 'alternate_address:ntext',
                            // 'facebook_link',
                            // 'linked_in_link',
                            // 'google_link',
                            // 'youtube_link',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'filter' => [1 => 'Enabled', 0 => 'Disabled'],
                                'value' => function ($model) {
                                    return $model->status == 1 ? 'Enabled' : 'Disabled';
                                },
                            ],
                            [
                                'attribute' => 'review_status',
                                'format' => 'raw',
                                'filter' => [1 => 'Reviewed', 0 => 'Unreviewed'],
                                'value' => function ($model) {
                                    return $model->review_status == 1 ? 'Reviewed' : 'Unreviewed';
                                },
                            ],
                            // 'date_of_creation',
                            // 'date_of_updation',
                            // 'email_varification_status:email',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}{update}',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


