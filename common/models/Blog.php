<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $image
 * @property string $image_alt
 * @property string $title
 * @property string $content
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $date
 * @property string $DOU
 * @property int $status
 */
class Blog extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'content', 'date'], 'required'],
            [['content', 'date', 'image_alt'], 'string'],
//            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'required', 'on' => 'create'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png,jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'title' => 'Title',
            'content' => 'Content',
            'date' => 'Date',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }

}
