<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_groups".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_active
 * @property integer $display_name
 *
 * @property Menu[] $menus
 */
class MenuGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'display_name'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название группы',
            'is_active' => 'Активна',
            'display_name' => 'Отображать название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasMany(Menu::className(), ['group_id' => 'id']);
    }
}
