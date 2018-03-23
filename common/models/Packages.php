<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $package_name
 * @property int $no_of_days
 * @property int $no_of_profile_view
 * @property string $package_price
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Packages extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['no_of_days', 'no_of_profile_view', 'package_price', 'package_name'], 'required'],
            [['no_of_days', 'no_of_profile_view', 'status', 'CB', 'UB'], 'integer'],
            [['package_price'], 'number'],
            [['DOC', 'DOU'], 'safe'],
            [['package_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'package_name' => 'Package Name',
            'no_of_days' => 'No Of Days',
            'no_of_profile_view' => 'No Of Profile View',
            'package_price' => 'Package Price',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
