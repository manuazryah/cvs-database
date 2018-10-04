<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class PackageExpiry extends Controller {

    public function actionIndex() {

        $user_plans = \common\models\EmployerPackages::find()->all();
        if (!empty($user_plans)) {
            foreach ($user_plans as $user_plan) {
                $now = time();
                $date = $user_plan->end_date;

                if (strtotime($date) < $now) {
                    $user_plan->no_of_downloads_left = 0;
                    $user_plan->save();
                }
            }
        }
    }

}
