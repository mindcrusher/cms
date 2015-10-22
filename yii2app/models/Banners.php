<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sliders".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property string $url
 * @property string $html
 * @property integer $is_active
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sliders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id'], 'required'],
            [['photo_id', 'is_active'], 'integer'],
            [['html'], 'string'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo_id' => Yii::t('app', 'Изображение'),
            'url' => Yii::t('app', 'URL'),
            'html' => Yii::t('app', 'Текст'),
            'is_active' => Yii::t('app', 'Активность'),
        ];
    }
}
