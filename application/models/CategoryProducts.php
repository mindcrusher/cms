<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_products".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $product_id
 * @property integer $is_active
 */
class CategoryProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id'], 'required'],
            [['category_id', 'product_id', 'is_active'], 'integer'],
            [['category_id', 'product_id'], 'unique', 'targetAttribute' => ['category_id', 'product_id'], 'message' => 'The combination of Категория and Товар has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'product_id' => 'Товар',
            'is_active' => 'Активность',
        ];
    }

    /**
     * @inheritdoc
     * @return CategoryProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryProductsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
