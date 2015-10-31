<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 31.10.2015
 * Time: 0:20
 */

namespace app\models;


use kgladkiy\behaviors\NestedSetQuery;
use app\components\behaviors\NestedSetsQueryBehavior;

class CategoryQuery extends NestedSetQuery
{
    public function behaviors()
    {
        return [
            [
                'class' => NestedSetsQueryBehavior::className(),
            ]
        ];
    }
}