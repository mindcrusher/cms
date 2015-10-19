<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id
 * @property string $contact_name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $protection_object
 * @property string $services_list
 * @property string $requirements
 * @property integer $space
 * @property string $protection_systems
 * @property string $payment_conditions
 */
class Pending extends \yii\db\ActiveRecord
{
    public $verifyCode;

    const MAIL_SUBJECT = 'Заявка с сайта';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pending';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_name', 'phone', 'services_list'], 'required'],
            [['space','phone'], 'integer'],
            [['contact_name'], 'string', 'max' => 63],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 45],
            [['address', 'protection_object', 'services_list', 'requirements', 'protection_systems', 'payment_conditions'], 'string', 'max' => 255],
        //    ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_name' => 'Контактное лицо',
            'phone' => 'Контактный телефон',
            'email' => 'E-Mail',
            'address' => 'Адрес объекта',
            'protection_object' => 'Описать объект охраны',
            'services_list' => 'Перечень необходимых услуг безопасности',
            'requirements' => 'Требования к охране и охранникам',
            'space' => 'Площадь объекта(кв.м.)',
            'protection_systems' => 'Наличие систем безопасности',
            'payment_conditions' => 'Условия по оплате',
            'verifyCode' => 'Проверочный код',
        ];
    }

    public function beforeSave( $insert )
    {
        if ($this->validate()) {

            $body = print_r($this->attributes, true);

            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['ownerEmail'])
                ->setFrom([$this->email => $this->contact_name])
                ->setSubject(self::MAIL_SUBJECT)
                ->setTextBody($body)
                ->send();

        }

        return true;
    }
}
