<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $middlename
 * @property string $surname
 * @property string $phone
 * @property string $gender
 *
 * @property Orders[] $orders
 * @property Subscribers[] $subscribers
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['firstname', 'middlename', 'surname', 'phone'], 'required'],
            [['gender'], 'string'],
            [['firstname', 'middlename', 'surname'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 20],
            [['phone'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'firstname' => 'Имя',
            'middlename' => 'Отчество',
            'surname' => 'Фамилия',
            'phone' => 'Телефон',
            'gender' => 'Пол',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Addresses::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscribers()
    {
        return $this->hasMany(Subscribers::className(), ['client_id' => 'id']);
    }

    public function getAppeal()
    {
        return rtrim("Уважаем" . ( $this->gender ? "ый" : "ая") . ' ' . $this->firstname . ' ' . $this->middlename);
    }

    public function getPrimaryAddress()
    {
        foreach ($this->addresses as $address) {
            if($address->is_primary) {
                return $address;
            }
        }
    }
}
