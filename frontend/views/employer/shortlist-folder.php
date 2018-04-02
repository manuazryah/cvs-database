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

                </div>
                <div class="panel-body">
                    <?php foreach ($model as $value) { ?>
                        <div class="col-md-1 text-aln">
                            <?= Html::a('<i class="fa fa-folder-open"></i><br/><span>' . $value->folder_name . '</span>', ['view-cv', 'id' => $value->folder_name], ['class' => '']) ?>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


