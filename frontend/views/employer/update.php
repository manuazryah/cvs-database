<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employer */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Employers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-users-index edit-profile">
     <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                <span><strong>For Support Contact Us: </strong><ul><li><a href="tel:+971 50 4752515"><i class="fa fa-phone"></i> +971 50 4752515</a></li><li><a href="mailto:info@cvs.ae"><i class="fa fa-envelope-o"></i> info@cvs.ae</a></li></ul></span>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="admin-users-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
