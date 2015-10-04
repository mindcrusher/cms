<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_modifications_groups".
 *
 * @property integer $id
 * @property string $title
 * @property integer $is_active
 *
 * @property CalcModifications[] $calcModifications
 */
class CalcModificationsGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_modifications_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['id', 'is_active'], 'integer'],
            [['title'], 'string', 'max' => 63]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'is_active' => 'Активна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalcModifications()
    {
        return $this->hasMany(CalcModifications::className(), ['group_id' => 'id']);
    }
}
