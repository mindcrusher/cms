<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_offer".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $photo_id
 * @property string $sku
 * @property string $price
 * @property integer $is_active
 *
 * @property Products $product
 */
class ProductOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'sku', 'price'], 'required'],
            [['product_id', 'photo_id', 'is_active'], 'integer'],
            [['sku', 'price'], 'string', 'max' => 45],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'photo_id' => 'Photo ID',
            'sku' => 'Sku',
            'price' => 'Price',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return ProductOfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductOfferQuery(get_called_class());
    }

    public function getPrice()
    {
        return $this->price;
    }
}
