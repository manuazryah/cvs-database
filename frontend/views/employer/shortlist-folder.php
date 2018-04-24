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
                    <section class="mailbox-env">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box">
                                <div class="job_title">Folders</div>
                                <div class="borderfull-width"></div>
                                <div class="clearfix"></div>
                                <div class="page-heading check-label shortlist-folder-label">
                                    <ul>
                                        <li>
                                            <?= Html::a('<i class="fa fa-folder-open"></i>  All', ['shortlist-folder'], ['class' => 'btn btn-folder-view']) ?>
                                        </li>
                                        <?php
                                        $folders = common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->groupBy('folder_name')->all();
                                        $arr_fldr = [];
                                        if (!empty($folders)) {
                                            foreach ($folders as $folder) {
                                                ?>
                                                <li>
                                                    <?= Html::a('<i class="fa fa-folder-open"></i>  ' . $folder->folder_name, ['shortlist-folder', 'folder' => $folder->folder_name], ['class' => 'btn btn-folder-view']) ?>
                                                    <ul class="options">
                                                        <li>
                                                            <?= Html::a('<i class="fa fa-trash"></i>', ['remove-folder', 'folder' => $folder->folder_name], ['class' => 'btn btn-folder-view fld-remove', 'onclick' => "return confirm('Are you sure to delete this folder?')"]) ?>
                                                        </li>
                                                        <li>
                                                            <a href="" class="btn btn-folder-view fld-rename" id="" data-val="<?= $folder->folder_name ?>"><i class="fa fa-edit"></i></a>
                                                            <?php // Html::a('<i class="fa fa-edit"></i>', ['remove-folder', 'folder' => $folder->folder_name], ['class' => 'btn btn-folder-view fld-rename']) ?>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 prit0">
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.fld-rename', function (e) {
            e.preventDefault();
            var folder_name = $(this).attr('data-val');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {folder_name: folder_name},
                url: '<?= Yii::$app->homeUrl ?>employer/get-rename-form',
                success: function (data) {
                    $(".modal-content").html(data);
                    $('#modal-6').modal('show', {backdrop: 'static'});
                }
            });
        });
        $(document).on('click', '.fld-move', function (e) {
            e.preventDefault();
            var candidate_id = $(this).attr('data-val');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {candidate_id: candidate_id},
                url: '<?= Yii::$app->homeUrl ?>employer/get-move-folder',
                success: function (data) {
                    $(".modal-content").html(data);
                    $('#modal-6').modal('show', {backdrop: 'static'});
                }
            });
        });

        $(document).on('submit', '#rename-form', function (e) {
            e.preventDefault();
            var old_folder_name = $('#old-folder_name').val();
            var new_folder_name = $('#new-folder_name').val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {old_folder_name: old_folder_name, new_folder_name: new_folder_name},
                url: '<?= Yii::$app->homeUrl ?>employer/rename-folder',
                success: function (data) {
                    $('#modal-6').modal('hide');
                    location.reload();
                }
            });
        });
        $(document).on('submit', '#move-folder-form', function (e) {
            e.preventDefault();
            var candidate_id = $('#candidate_id').val();
            var new_folder_name = $('#new-folder_name').val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {candidate_id: candidate_id, new_folder_name: new_folder_name},
                url: '<?= Yii::$app->homeUrl ?>employer/move-folder',
                success: function (data) {
                    $('#modal-6').modal('hide');
                    location.reload();
                }
            });
        });
    }
    );
</script>

