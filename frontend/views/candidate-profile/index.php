<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidate Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-profile-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Candidate Profile</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'candidate_id',
            'name',
            'nationality',
            'current_country',
            // 'current_city',
            // 'expected_salary',
            // 'job_type',
            // 'gender',
            // 'dob',
            // 'photo',
            // 'job_status',
            // 'executive_summary:ntext',
            // 'industry',
            // 'skill',
            // 'hobbies',
            // 'extra_curricular_activities:ntext',
            // 'languages_known',
            // 'driving_licences',
            // 'title',
            // 'date_of_updation',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


