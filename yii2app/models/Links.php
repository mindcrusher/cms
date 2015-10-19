<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
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
            [['page_id'], 'required'],
            [['page_id', 'is_active', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 45],
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
            'page_id' => 'Страница',
            'is_active' => 'Активна',
            'sort' => 'Сортировка',
        ];
    }

    public function getUrl()
    {
        return $this->is_url ? $this->url : ['/site/info', 'alias' => $this->alias];
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

    public function beforeSave( $insert )
    {
        $alias = \app\components\Helper::translit($this->name);

        if(!empty($this->alias)) {
            $r = new RedirectRules();
            $r->from = Url::to($this->getUrl());

            if($this->id == 1) {
                $this->is_url = true;
                $this->alias = null;
                $this->url = '/';
            } else {
                $this->alias = $alias;
            }
            $r->status_code = 301;
            $r->to = Url::to($this->getUrl());
            $r->save();
        } else {
            $this->alias = $alias;
        }
        return true;
    }
}
