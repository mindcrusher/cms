<?php

namespace app\models;

use Yii;
use yii\bootstrap\Html;

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
        return 'banners';
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
            [['url','title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo_id' => 'Изображение',
            'url' => 'URL',
            'html' => 'Текст',
            'title' => 'Заголовок',
            'begin_time' => 'Начало показа',
            'end_time' => 'Конец показа',
            'is_active' => 'Активность',
        ];
    }

    public static function findActive()
    {
        return self::find()
                ->where('is_active = 1')
                ->andWhere('NOW() between begin_time and end_time')
                ->all();
    }

    public function getContent()
    {
        $content = null;
        $caption = $this->title;
        if(!empty($this->photo_id)) {
            $content = html::a(Html::img($this->file->getUrl()), $this->url);
        } else {
            $content = $this->html;
        }

        return [
            'content' => $content,
            'caption' => $caption,
        ];
    }

    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'photo_id']);
    }
}
