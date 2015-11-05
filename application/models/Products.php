<?php

namespace app\models;

use app\components\Helper;
use app\components\behaviors\UrlBehavior;
use Yii;
use yii\helpers\Url;

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
            'title' => 'Заголовок',
            'description' => 'Описание',
            'condition' => 'Состав',
            'result' => 'Результат',
            'applyment' => 'Применение',
            'price' => 'Цена',
            'is_active' => 'Активность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(ProductOffer::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CategoryProducts::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }

    public function getPhotos()
    {
        return $this->hasMany(ProductPhotos::className(), ['product_id' => 'id'])->innerJoin('files', 'product_photos.photo_id = files.id');
    }

    public function mainPhoto()
    {
        foreach ( $this->photos as $photo) {
            if($photo->is_primary)
                break;
        }

        return $photo->file;
    }

    public function hasPhotos()
    {
        return count($this->photos) > 0;
    }

    public function beforeSave( $insert )
    {
        $alias = Helper::translit($this->title);

        if(!empty($this->slug)) {
            $r = new RedirectRules();
            $r->from = Url::to($this->getUrl());
            $this->slug = $alias;
            $r->status_code = RedirectRules::REDIRECT_STATUS_PERMANENT;
            $r->to = Url::to($this->getUrl());
            $r->save();
        } else {
            $this->alias = $alias;
        }
        return true;
    }
}
