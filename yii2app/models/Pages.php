<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property string $text
 * @property integer $is_active
 * @property string $created_time
 * @property string $updated_time
 *
 * @property Menu[] $menus
 * @property Seo $id0
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['is_active'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['alias', 'title', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'ЧПУ',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'text' => 'Текст',
            'is_active' => 'Активна',
            'created_time' => 'Время создания',
            'updated_time' => 'Последнее обновление',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Seo::className(), ['page_id' => 'id']);
    }
}
