<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   
            <?= $form->field($model, 'image', ['options' => ['class' => 'form-group'], 'template' => '{label}<label>Image [ Max File Size :( 770x530 ) ]</label>{input}{error}'])->fileInput(['maxlength' => true])->label(FALSE) ?>
            <?php
            if ($model->isNewRecord)
                echo "";
            else {
                if (!empty($model->image)) {
                    ?>

                    <img src="<?= Yii::$app->homeUrl ?>../uploads/blog/<?= $model->id ?>/small.<?= $model->image; ?>" width="100" height="70"/>
                    <?php
                }
            }
            ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'image_alt')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        </div>
        
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>   
            <?=
            $form->field($model, 'content', ['options' => ['class' => 'form-group']])->widget(CKEditor::className(), [
                'options' => ['rows' => 2],
                'preset' => 'custom',
            ])
            ?>

        </div>       
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
            <?=
            $form->field($model, 'date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy'
                ]
            ])->label('Date');
            ?>

        </div>      
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

        </div>      
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
