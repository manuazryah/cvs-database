<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">

                    <section class="mailbox-env">

                        <div class="row">

                            <!-- Inbox emails -->
                            <div class="col-sm-9 mailbox-right">

                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        'id',
                                            ['class' => 'yii\grid\ActionColumn'],
                                    ],
                                ]);
                                ?>

                            </div>

                            <!-- Mailbox Sidebar -->
                            <div class="col-sm-3 mailbox-left">
                                <div class="mailbox-sidebar">
                                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>


