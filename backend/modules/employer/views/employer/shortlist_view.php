<?php

use common\components\CandidateViewWidget;

$candidate_data = \common\models\CandidateProfile::find()->where(['candidate_id' => $model->candidate_id])->one();
?>

<?= CandidateViewWidget::widget(['id' => $candidate_data->id]) ?>