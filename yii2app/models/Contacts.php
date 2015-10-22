<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $type
 * @property string $value
 * @property integer $sort
 * @property integer $is_active
 * @property string $created_time
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['sort', 'is_active'], 'integer'],
            [['created_time'], 'safe'],
            [['value'], 'string', 'max' => 63],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Тип'),
            'value' => Yii::t('app', 'Значение'),
            'sort' => Yii::t('app', 'Порядок сортировки'),
            'is_active' => Yii::t('app', 'Активность'),
            'created_time' => Yii::t('app', 'Created Time'),
        ];
    }
}
