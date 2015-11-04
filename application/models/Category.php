<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.10.2015
 * Time: 21:08
 */

namespace app\models;

use app\components\Helper;
use yii\db\ActiveRecord;
use app\components\behaviors\UrlBehavior;
use kgladkiy\behaviors\NestedSetBehavior;

class Category extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => NestedSetBehavior::className(),
                // 'rootAttribute' => 'root',
                'levelAttribute' => 'lvl',
                'hasManyRoots' => true
            ],
            [
                'class' => UrlBehavior::className(),
                'route' => '/catalog/default/category',
                'slugAttribute' => 'slug',
            ]
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function getProducts( $depth = null )
    {
        $sections = [$this->id];
        $descendants = $this->descendants($depth)->all();
        foreach ($descendants as $cat) {
            $sections[] = $cat->id;
        }

        return CategoryProducts::find()
            ->where(['in', 'category_id', $sections])
            ->groupBy('product_id');
    }

    public function getFreeProducts()
    {
        return Products::find()
            ->select(['id as value', 'title as  label', 'id'])
            ->asArray()
            ->all();
    }

    public function beforeSave( $insert )
    {
        if(empty($this->slug)) {
            $this->slug = Helper::translit( $this->name );
        }
        return parent::beforeSave( $insert );
    }
}