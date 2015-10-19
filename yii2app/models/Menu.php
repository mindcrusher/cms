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
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
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
            'name' => 'Название',
            'is_active' => 'Активна',
            'display_name' => 'Отображать название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(MenuRelations::className(), ['menu_id' => 'id']);
    }

    public function getFreeLinks()
    {
        return Links::find()
            ->joinWith('menu')
            ->where('links.id not in ( select link_id from menu_relations where menu_id = :id)', [':id' => $this->id])
            ->groupBy('links.name')
            //->orderBy('links.name')
            ->select(['links.id as value', 'name as  label','links.id'])
            ->asArray()
            ->all();
    }
}
