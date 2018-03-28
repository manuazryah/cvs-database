<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "login_history".
 *
 * @property int $id
 * @property int $client_type 1->admin,2->candidate,3->employer
 * @property int $client_id
 * @property string $ip_address
 * @property string $browser
 * @property string $country
 * @property string $log_in_time
 * @property string $log_out_time
 */
class LoginHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'login_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_type', 'client_id'], 'integer'],
            [['log_in_time', 'log_out_time'], 'safe'],
            [['ip_address', 'country'], 'string', 'max' => 100],
            [['browser'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_type' => 'Client Type',
            'client_id' => 'Client ID',
            'ip_address' => 'Ip Address',
            'browser' => 'Browser',
            'country' => 'Country',
            'log_in_time' => 'Log In Time',
            'log_out_time' => 'Log Out Time',
        ];
    }
}
