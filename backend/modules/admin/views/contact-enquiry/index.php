<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactEnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-enquiry-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                            'name',
                            'email:email',
                            'subject',
                            [
                                'attribute' => 'message',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return wordwrap($data->message, 50, "<br />\n");
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


