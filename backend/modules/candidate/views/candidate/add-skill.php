<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Industry */

$this->title = 'Add Skills';
$this->params['breadcrumbs'][] = ['label' => 'Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body"><div class="candidate-create">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'industry')->hiddenInput(['value' => 0])->label(FALSE) ?>
                        <?= $form->field($model, 'skill')->textInput(['maxlength' => true]) ?>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success mrg-top-btn', 'id' => 'add_skill']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #modalContent{
        display: inline-block;
        width: 100%;
    }
    #maincontent{
        padding: 0px;
    }
</style>
<script>

    $('#add_industry').click(function (event) {
        event.preventDefault();
        if (valid()) {
            var industry_name = $('#industry-industry_name').val();
            $.ajax({
                url: '<?= Yii::$app->homeUrl ?>candidate/candidate/add-industry',
                type: "post",
                data: {industry_name: industry_name},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.con === "1") {
                        var newOption = $('<option value="' + $data.id + '">' + $data.name + '</option>');
                        $('#candidateprofile-industry').append(newOption);
                        $('#candidateprofile-industry' + ' option[value=' + $data.id + ']').attr("selected", "selected");
                        var vals = $('#candidateprofile-industry').val();
                        $('#candidateprofile-industry').select2('val', vals);
                        $('#modal').modal('hide');
                    } else {
                        alert($data.error);
                    }

                }, error: function () {

                }
            });
        } else {
//            alert('Please fill the Field');
        }

    });
    var valid = function () { //Validation Function - Sample, just checks for empty fields
        var valid;
        $("input").each(function () {
            if (!$('#industry-industry_name').val()) {
                $('#industry-industry_name').focus();
                valid = false;
            }
        });
        if (valid !== false) {
            return true;
        } else {
            return false;
        }
    }

    $('#add_skill').click(function (event) {
        event.preventDefault();
        if (validSkill()) {
            var skill = $('#skills-skill').val();
            var industry = $('#skills-industry').val();
            $.ajax({
                url: '<?= Yii::$app->homeUrl ?>candidate/candidate/add-skill',
                type: "post",
                data: {industry: industry, skill: skill},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.con === "1") {
                        var newOption = $('<option value="' + $data.id + '">' + $data.name + '</option>');
                        $('#candidateprofile-skill').append(newOption);
                        $('#candidateprofile-skill' + ' option[value=' + $data.id + ']').attr("selected", "selected");
                        var vals = $('#candidateprofile-skill').val();
                        $('#candidateprofile-skill').select2('val', vals);
                        $('#modal').modal('hide');
                    } else {
                        alert($data.error);
                    }

                }, error: function () {

                }
            });
        } else {
//            alert('Please fill the Field');
        }

    });
    var validSkill = function () { //Validation Function - Sample, just checks for empty fields
        var valid;
        $("input").each(function () {
            if (!$('#skills-skill').val()) {
                $('#skills-skill').focus();
                valid = false;
            }
        });
        if (valid !== false) {
            return true;
        } else {
            return false;
        }
    }
</script>
