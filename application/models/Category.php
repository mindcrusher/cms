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
        return CategoryProducts::find()
            ->where(['in', 'category_id', $this->getNestedCategories()])
            ->groupBy('product_id');
    }

    public function getFreeProducts()
    {
        return Products::find()
            ->select(['products.id as value', 'title as  label', 'products.id'])
            ->joinWith('categories')
            ->where(['not in', 'category_id', $this->getNestedCategories()])
            ->orWhere('category_products.id is null')
            ->asArray()
            ->all();
    }

    public function getNestedCategories()
    {
        $sections = [$this->id];
        $descendants = $this->children()->all();
        foreach ($descendants as $cat) {
            $sections[] = $cat->id;
        }

        return $sections;
    }

    public function beforeSave( $insert )
    {
        if(empty($this->slug)) {
            $this->slug = Helper::translit( $this->name );
        }
        return parent::beforeSave( $insert );
    }
}