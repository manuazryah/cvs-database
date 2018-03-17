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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Candidate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            //'user_name',
            //'password',
            //'gender',
            //'dob',
            //'nationality',
            //'current_country',
            //'current_city',
            //'address:ntext',
            //'position',
            //'position_looking_for',
            //'sub_position',
            //'qualification',
            //'skill_set',
            //'experience',
            //'upload_cv',
            //'status',
            //'date_of_creation',
            //'date_of_updation',
            //'email_varification_status:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
