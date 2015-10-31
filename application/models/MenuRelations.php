<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_relations".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property integer $link_id
 */
class MenuRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'link_id'], 'integer'],
            [['menu_id', 'link_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'link_id' => 'Страница',
        ];
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['menu_id' => 'id']);
    }

    public function getLink()
    {
        return $this->hasOne(Links::className(), ['id' => 'link_id']);
    }
}
