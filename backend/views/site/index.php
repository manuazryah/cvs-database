<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'CVS Database Admin Panel';
?>
<div class="row">
    <div class="col-md-12">

        <!-- Default panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Candidate Details
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">

                        <!-- Bordered panel -->
                        <div class="panel panel-default panel-border panl-heigh">
                            <div class="panel-heading">
                                Reviewed
                            </div>

                            <div class="panel-body">
                                <div class="home-candidate-view">
                                    <div class="home-candidate-sub">
                                        <table class="table table-bordered table-striped table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                if (!empty($reviewed_candidate)) {
                                                    $i = 0;
                                                    foreach ($reviewed_candidate as $reviewed) {
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <td><?= $i ?></td>
                                                            <td><?= $reviewed->user_name ?></td>
                                                            <td><?= $reviewed->email ?></td>
                                                            <td><?= $reviewed->phone ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php if (!empty($reviewed_candidate)) { ?>
                                        <?= Html::a('<i class="fa fa-arrow-right"></i><span> View All</span>', ['/candidate/candidate/reviewed-candidate'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'float:right;']) ?>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <!-- Bordered panel -->
                        <div class="panel panel-default panel-border panl-heigh">
                            <div class="panel-heading">
                                Unreviewed
                            </div>

                            <div class="panel-body">
                                <div class="home-candidate-view">
                                    <table class="table table-bordered table-striped table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (!empty($unreviewed_candidate)) {
                                                $j = 0;
                                                foreach ($unreviewed_candidate as $unreviewed) {
                                                    $j++;
                                                    ?>
                                                    <tr>
                                                        <td><?= $j ?></td>
                                                        <td><?= $unreviewed->user_name ?></td>
                                                        <td><?= $unreviewed->email ?></td>
                                                        <td><?= $unreviewed->phone ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <?php if (!empty($unreviewed_candidate)) { ?>
                                        <?= Html::a('<i class="fa fa-arrow-right"></i><span> View All</span>', ['/candidate/candidate/unreviewed-candidate'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'float:right;']) ?>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
