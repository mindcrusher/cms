<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $address_id
 * @property integer $delivery_id
 * @property double $cost
 * @property string $customer_comment
 * @property string $seller_comment
 *
 * @property Addresses $address
 * @property Customers $customer
 * @property DeliveryTypes $delivery
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'address_id', 'delivery_id'], 'integer'],
            [['cost'], 'number'],
            [['customer_comment'], 'string', 'max' => 255],
            [['seller_comment'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Покупатель',
            'address_id' => 'Адрес',
            'delivery_id' => 'тип доставки',
            'cost' => 'Стоимость',
            'customer_comment' => 'Комментарий покупателя',
            'seller_comment' => 'Комментарий продавца',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Addresses::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(DeliveryTypes::className(), ['id' => 'delivery_id']);
    }
}
