<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employer', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'password',
            //'company_name',
            //'country',
            //'location',
            //'address:ntext',
            //'company_email:email',
            //'company_phone_number',
            //'position',
            //'status',
            //'DOC',
            //'DOU',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
