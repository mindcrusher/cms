<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 01.03.2015
 * Time: 17:30
 */

namespace app\models;

use yii\base\Exception;

class CheckoutForm extends \yii\base\Model
{
    public $customer_comment;

    public $firstname;
    public $middlename;
    public $surname;
    public $phone;
    public $gender;

    public $zipcode;
    public $formatted_address;

    public $delivery_id;

    public function rules()
    {
        return [
                [['firstname', 'middlename', 'phone', 'gender', 'formatted_address'], 'required'],
                [['firstname', 'middlename', 'surname'], 'string', 'min' => 2, 'max' => 20],
                [['phone'], 'string', 'max' => 20],
                [['phone'], 'integer']
        ];
    }

    public function save()
    {
        $customer = Customers::findOne(['phone' => $this->phone]);
        if(empty($customer)) {
            $customer = new Customers();
            if(!\Yii::$app->user->isGuest) {
                $customer->user_id = \Yii::$app->user->id;
            }
            $customer->attributes = $this->attributes;
            if( !$customer->save()) {
                var_dump($customer->getErrors());exit;
                throw new Exception('Fail to save customer');
            }
        }

        $address = Addresses::findOne([
                        'formatted' => $this->formatted_address,
                        'zipcode' => $this->zipcode,
                        'customer_id' => $customer->id,
                    ]);

        if( empty($address) ) {
            $address = new Addresses();
            $address->zipcode = $this->zipcode;
            $address->formatted = $this->formatted_address;
            $address->customer_id = $customer->id;

            if( !$address->save()) {
                throw new Exception("Fail to save new address");
            }
        }

        $order = new Orders();
        $order->attributes = $this->attributes;
        $order->customer_id = $customer->id;
        $order->address_id = $address->id;
        //$order->delivery_id = $this->delivery_id;
        $order->cost = \Yii::$app->cart->getCost();
        if( !$order->save()) {
            throw new Exception("Fail to save order");
        } else {
            return $order;
        }
    }

    public function attributeLabels()
    {
        return [
            'firstname' => 'Имя',
            'middlename' => 'Фамилия',
            'surname' => 'Отчество',
            'phone' => 'Телефон',
            'zipcode' => 'Индекс',
            'formatted_address' => 'Адрес',
            'customer_comment' => 'Комментарий',
        ];
    }
}