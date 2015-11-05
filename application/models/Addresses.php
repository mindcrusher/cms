<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "addresses".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $is_primary
 * @property integer $zipcode
 * @property string $formatted
 *
 * @property Orders[] $orders
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'formatted'], 'required'],
            [['customer_id', 'zipcode'], 'integer'],
            [['is_primary'], 'string'],
            [['formatted'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'is_primary' => 'Is Primary',
            'zipcode' => 'Zipcode',
            'formatted' => 'Formatted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['address_id' => 'id']);
    }
}
