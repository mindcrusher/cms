<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $group_id
 * @property integer $page_id
 * @property integer $is_active
 * @property integer $sort
 *
 * @property Pages $page
 * @property Menu $group
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'page_id'], 'required'],
            [['group_id', 'page_id', 'is_active', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['group_id', 'page_id'], 'unique', 'targetAttribute' => ['group_id', 'page_id'], 'message' => 'The combination of Группа and Страница has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Текст ссылки',
            'group_id' => 'Группа',
            'page_id' => 'Страница',
            'is_active' => 'Активна',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(MenuRelations::className(), ['link_id' => 'id']);
    }
}
