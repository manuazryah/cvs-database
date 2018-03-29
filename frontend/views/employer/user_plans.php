<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Package Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'package_name',
                            'no_of_days',
                            'no_of_profile_view',
                            'package_price',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:100px;'],
                                'header' => 'Actions',
                                'template' => '{select}',
                                'buttons' => [
                                    'select' => function ($url, $model) {
                                        return Html::a('Select', $url, [
                                                    'title' => Yii::t('app', 'select'),
                                                    'class' => 'btn btn-secondary',
                                                    'style' => 'padding: 4px 10px;border-radius: 5px;',
                                        ]);
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'select') {
                                        $url = Url::to(['select-plan', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id)]);
                                        return $url;
                                    }
                                }
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


