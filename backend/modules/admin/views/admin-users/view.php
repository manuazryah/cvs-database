<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminUsers;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUsers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Admin Users</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="admin-users-view">
                        <p>
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?=
                            Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </p>

                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//                                                        'id',
                                    [
                                    'attribute' => 'post_id',
                                    'value' => call_user_func(function($model) {
                                                if ($model->post_id != '') {
                                                    return \common\models\AdminPosts::findOne($model->post_id)->post_name;
                                                } else {
                                                    return '';
                                                }
                                            }, $model),
                                ],
                                'name',
                                'email:email',
                                'phone',
                                'address:ntext',
                                    [
                                    'attribute' => 'status',
                                    'value' => call_user_func(function($model) {
                                                if ($model->status == 1) {
                                                    return 'ENABLED';
                                                } else {
                                                    return 'DISABLED';
                                                }
                                            }, $model),
                                ],
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


