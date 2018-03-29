<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExpectedSalary */

$this->title = 'Create Expected Salary';
$this->params['breadcrumbs'][] = ['label' => 'Expected Salaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Expected Salary</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="expected-salary-create">
                                                <?= $this->render('_form', [
                                                'model' => $model,
                                                ]) ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
                
