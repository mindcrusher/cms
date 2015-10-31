<?php

namespace app\models;

use app\components\Helper;
use app\components\behaviors\UrlBehavior;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property integer $is_active
 *
 * @property ProductOffer[] $productOffers
 */
class Products extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => UrlBehavior::className(),
                'route' => '/catalog/default/product',
                'slugAttribute' => 'slug',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['is_active'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOffers()
    {
        return $this->hasMany(ProductOffer::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }

    public function beforeSave( $insert )
    {
        $this->slug = Helper::translit($this->title);
        return true;
    }
}
