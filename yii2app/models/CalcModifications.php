<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_modifications".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $title
 * @property integer $mode_factor
 *
 * @property CalcModificationsGroups $group
 */
class CalcModifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_modifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'mode_factor', 'title'], 'required'],
            [['group_id', 'mode_factor'], 'integer'],
            [['title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'title' => 'Название',
            'mode_factor' => 'Модификатор влияния, %',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CalcModificationsGroups::className(), ['id' => 'group_id']);
    }
}
