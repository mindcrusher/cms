<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 31.10.2015
 * Time: 10:14
 */
namespace app\components\behaviors;

use yii\base\Behavior;
use yii\helpers\Url;

class UrlBehavior extends Behavior
{
    public $route;

    public $slugAttribute = 'id';

    public function getUrl()
    {
        return Url::to( [
            $this->route,
            $this->slugAttribute => $this->owner->{$this->slugAttribute}
        ] );
    }
}