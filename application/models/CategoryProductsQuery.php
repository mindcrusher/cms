<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CategoryProducts]].
 *
 * @see CategoryProducts
 */
class CategoryProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CategoryProducts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CategoryProducts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}