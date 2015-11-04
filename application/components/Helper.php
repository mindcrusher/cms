<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 14.10.2015
 * Time: 21:41
 */

namespace app\components;


use app\models\RedirectRules;
use yii\base\Object;

class Helper
{
    
    private static $country_code = '+7';
    
    /**
     * Транслитерация русского текста в латиницу
     * @param type $st
     * @return type
     */
    public static function translit($st)
    {
        $replace = array(
            " " => "-",
            "'" => "",
            "." => ".",
            "`" => "",
            "а" => "a", "А" => "a",
            "б" => "b", "Б" => "b",
            "в" => "v", "В" => "v",
            "г" => "g", "Г" => "g",
            "д" => "d", "Д" => "d",
            "е" => "e", "Е" => "e",
            "ж" => "zh", "Ж" => "zh",
            "з" => "z", "З" => "z",
            "и" => "i", "И" => "i",
            "й" => "y", "Й" => "y",
            "к" => "k", "К" => "k",
            "л" => "l", "Л" => "l",
            "м" => "m", "М" => "m",
            "н" => "n", "Н" => "n",
            "о" => "o", "О" => "o",
            "п" => "p", "П" => "p",
            "р" => "r", "Р" => "r",
            "с" => "s", "С" => "s",
            "т" => "t", "Т" => "t",
            "у" => "u", "У" => "u",
            "ф" => "f", "Ф" => "f",
            "х" => "h", "Х" => "h",
            "ц" => "c", "Ц" => "c",
            "ч" => "ch", "Ч" => "ch",
            "ш" => "sh", "Ш" => "sh",
            "щ" => "sch", "Щ" => "sch",
            "ъ" => "", "Ъ" => "",
            "ы" => "y", "Ы" => "y",
            "ь" => "", "Ь" => "",
            "э" => "e", "Э" => "e",
            "ю" => "yu", "Ю" => "yu",
            "я" => "ya", "Я" => "ya",
            "і" => "i", "І" => "i",
            "ї" => "yi", "Ї" => "yi",
            "є" => "e", "Є" => "e"
        );
        $st = strtolower(strtr($st, $replace));
        $st = preg_replace('#[^a-z0-9\-]#', '', $st);

        return $st;
    }
    
    public static function formatPhone( $str )
    {
        $str = trim($str);
        if(preg_match('#^(\d{3})(\d{3})(\d{2})(\d{2})$#', $str, $match)) {
            $str = '(' . $match[1] . ')' . $match[2] . '-' . $match[3] . '-' . $match[4];
        }
        return self::$country_code . $str;
    }

    public static function boolLabel( $model , $attribute = 'is_active')
    {
        return $model->$attribute ? 'Да' : 'Нет';
    }
}