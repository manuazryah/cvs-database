<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shortlisted CVs/ Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <!-- Modal 6 (Long Modal)-->
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?php
                    $form1 = ActiveForm::begin([
                                'method' => 'post',
                                'id' => 'filter-search',
                    ]);
                    ?>
                    <section class="mailbox-env">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box">
                                <div class="job_title">Folders</div>
                                <div class="borderfull-width"></div>
                                <div class="clearfix"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $folders = common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->groupBy('folder_name')->all();
                                    $arr_fldr = [];
                                    if (!empty($folders)) {
                                        foreach ($folders as $folder) {
                                            if ($model_filter->cv_folder != '' && isset($model_filter->cv_folder)) {
                                                if (in_array($folder->folder_name, $model_filter->cv_folder)) {
                                                    $check1 = 'checked';
                                                } else {
                                                    $check1 = '';
                                                }
                                            } else {
                                                $check1 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check1 ?> name="CvFilter[cv_folder][]" value="<?= $folder->folder_name ?>"> <?= $folder->folder_name ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 prit0">
                                <div class="col-md-12 col-sm-12 p-l">
                                    <div class="page-heading">
                                        <?php
                                        $your_search_filter = '';
                                        if (isset($model_filter->cv_folder) && $model_filter->cv_folder != '') {
                                            foreach ($model_filter->cv_folder as $loc_value) {
                                                $your_search_filter .= '"' . $loc_value . '", ';
                                            }
                                        }
                                        ?>
                                        <p><span class="color-drk">Your Search Filter</span>: <?= $your_search_filter ?></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="page_listing candidate">
                                    <?php
                                    echo ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemView' => 'shortlist_view',
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            $("#filter-search").submit();
        });
    });
</script>

