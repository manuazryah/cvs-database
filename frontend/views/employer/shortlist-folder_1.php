<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shortlisted CVs/ Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-folder-list">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                    <?php // echo \yii\helpers\Html::a('Back', Yii::$app->request->referrer) ?>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($model as $value) {
                        $folder = strlen($value->folder_name) > 8 ? substr($value->folder_name, 0, 8) : $value->folder_name;
                        ?>
                        <div class="col-md-1 text-aln">
                            <div class="folder-box">
                                <div class="folder-box-remove"><i class="fa fa-remove"></i></div>
                                    <?= Html::a('<i class="fa fa-folder-open"></i><br/><span>' . $folder . '</span>', ['open-folder', 'folder' => $value->folder_name], ['title' => $value->folder_name]) ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


