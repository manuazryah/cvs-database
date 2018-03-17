<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            'user_name',
            'password',
            'gender',
            'dob',
            'nationality',
            'current_country',
            'current_city',
            'address:ntext',
            'position',
            'position_looking_for',
            'sub_position',
            'qualification',
            'skill_set',
            'experience',
            'upload_cv',
            'status',
            'date_of_creation',
            'date_of_updation',
            'email_varification_status:email',
        ],
    ]) ?>

</div>
