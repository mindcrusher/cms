<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property string $type
 * @property string $value
 * @property integer $sort
 * @property integer $is_active
 * @property string $created_time
 */
class Contacts extends \yii\db\ActiveRecord
{
    const TYPE_PHONE = 'phone';
    const TYPE_MOBILE = 'mobile';
    const TYPE_FAX = 'fax';
    const TYPE_EMAIL = 'mail';
    const TYPE_SKYPE = 'skype';
    
    public $iconMap = [
        'phone' => 'glyphicon glyphicon-phone-alt',
        'mobile' => 'glyphicon glyphicon-phone',
        'fax' => 'glyphicon glyphicon-phone-alt',
        'mail' => 'glyphicon glyphicon-send',
    ];
    
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['sort', 'is_active'], 'integer'],
            [['created_time'], 'safe'],
            [['value','description'], 'string', 'max' => 63],
            [['value', 'type'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'value' => 'Значение',
            'description' => 'Описание',
            'sort' => 'Порядок сортировки',
            'is_active' => 'Активность',
            'created_time' => 'Created Time',
        ];
    }
    
    public static function findAllActive()
    {
        return self::find()
            ->where(['is_active' => 1])
            ->orderBy(['type' => 'asc'])
            ->all();
    }
    
    public function formatted()
    {
        if(in_array($this->type, [ self::TYPE_PHONE, self::TYPE_MOBILE, self::TYPE_FAX])) {
            $string = \app\components\Helper::formatPhone( $this->value);
        } else {
            $string = $this->value;
        }
        
        return $string;
    }
    
    public function icon()
    {
        return $this->iconMap[$this->type];
    }
}
