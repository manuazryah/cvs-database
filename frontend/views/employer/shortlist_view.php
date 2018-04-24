<?php

use common\components\ShortlistViewWidget;

$candidate_data = \common\models\CandidateProfile::find()->where(['candidate_id' => $model->candidate_id])->one();
?>

<?= ShortlistViewWidget::widget(['id' => $candidate_data->id]) ?>