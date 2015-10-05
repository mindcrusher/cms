<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property integer $page_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 *
 * @property Pages $pages
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Страница',
            'title' => 'Заголовок Title',
            'description' => 'Заголовок Description',
            'keywords' => 'Заголовок Keywords',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }
}
