<?php

use common\components\AdminCandidateViewWidget;

$candidate_data = \common\models\CandidateProfile::find()->where(['candidate_id' => $model->candidate_id])->one();
?>

<?= AdminCandidateViewWidget::widget(['id' => $candidate_data->id]) ?>