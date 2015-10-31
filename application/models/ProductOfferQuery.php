<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProductOffer]].
 *
 * @see ProductOffer
 */
class ProductOfferQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProductOffer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductOffer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}