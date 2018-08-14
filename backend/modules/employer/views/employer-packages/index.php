<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Employer;
use common\models\Packages;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployerPackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employer Packages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-packages-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                            [
                                'attribute' => 'transaction_id',
                                'label' => 'Transaction',
                            ],
                            [
                                'attribute' => 'employer_id',
                                'label' => 'Employer',
                                'value' => function ($model) {
                                    $employer = '';
                                    if ($model->employer_id != '') {
                                        $employer = Employer::find()->where(['id' => $model->employer_id])->one();
                                    }
                                    if (!empty($employer) && $employer != '') {
                                        return $employer->first_name;
                                    } else {
                                        return '';
                                    }
                                },
                                'filter' => ArrayHelper::map(Employer::find()->asArray()->all(), 'id', 'first_name'),
                            ],
                            [
                                'attribute' => 'package',
                                'value' => function ($model) {
                                    return $model->package == '' ? '' : common\models\Packages::findOne($model->package)->package_name;
                                },
                                'filter' => ArrayHelper::map(Packages::find()->asArray()->all(), 'id', 'package_name'),
                            ],
//                            'start_date',
//                            'end_date',
                            // 'no_of_days',
                            // 'no_of_days_left',
                            // 'no_of_views',
                            // 'no_of_views_left',
                            // 'no_of_downloads',
                            [
                                'attribute' => 'no_of_downloads',
                                'label' => 'Total Credits',
                            ],
                            [
                                'attribute' => 'no_of_downloads_left',
                                'label' => 'Remaining Credits',
                            ],
                            [
                                'attribute' => 'end_date',
                                'label' => 'Expiry Date',
                            ],
                            // 'created_date',
                            // 'updated_date',
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


