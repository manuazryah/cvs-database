<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminPostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-posts-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Admin Posts</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                'id',
                            'post_name',
                            [
                                'attribute' => 'admin',
                                'filter' => [1 => 'Yes', 0 => 'No'],
                                'value' => function ($model) {
                                    return $model->admin == 1 ? 'Yes' : 'No';
                                },
                                'filter' => [1 => 'Yes', 0 => 'No'],
                            ],
                            [
                                'attribute' => 'masters',
                                'format' => 'raw',
                                'filter' => [1 => 'Yes', 0 => 'No'],
                                'value' => function ($model) {
                                    return $model->masters == 1 ? 'Yes' : 'No';
                                },
                            ],
                            [
                                'attribute' => 'employers',
                                'format' => 'raw',
                                'filter' => [1 => 'Yes', 0 => 'No'],
                                'value' => function ($model) {
                                    return $model->employers == 1 ? 'Yes' : 'No';
                                },
                            ],
                            [
                                'attribute' => 'jobseekers',
                                'format' => 'raw',
                                'filter' => [1 => 'Yes', 0 => 'No'],
                                'value' => function ($model) {
                                    return $model->jobseekers == 1 ? 'Yes' : 'No';
                                },
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'filter' => [1 => 'Enabled', 0 => 'disabled'],
                                'value' => function ($model) {
                                    return $model->status == 1 ? 'Enabled' : 'disabled';
                                },
                            ],
//            'CB',
//            'UB',
                            // 'DOC',
                            // 'DOU',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


