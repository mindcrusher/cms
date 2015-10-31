<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photos".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $product_id
 * @property integer $is_primary
 * @property integer $is_active
 */
class ProductPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id', 'product_id'], 'required'],
            [['photo_id', 'product_id', 'is_primary', 'is_active'], 'integer'],
            [['photo_id', 'product_id'], 'unique', 'targetAttribute' => ['photo_id', 'product_id'], 'message' => 'The combination of Photo ID and Product ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo_id' => Yii::t('app', 'Photo ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'is_primary' => Yii::t('app', 'Is Primary'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'photo_id']);
    }
}
