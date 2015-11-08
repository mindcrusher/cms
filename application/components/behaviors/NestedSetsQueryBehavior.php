<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 31.10.2015
 * Time: 0:23
 */

namespace app\components\behaviors;

use kgladkiy\behaviors\NestedSetQueryBehavior;

class NestedSetsQueryBehavior extends NestedSetQueryBehavior
{
    public function tree($root = false, $maxLevel = false)
    {

        $tree = [];

        if ($root === false) {
            $ownerClass = $this->owner->modelClass;
            $items = $this->owner->all();
        } else {
            if (!$maxLevel || $root->level <= $maxLevel) {
                $items = $root->children()->all();
            } else {
                return $tree;
            }
        }

        foreach ($items as $item) {
            $tree[$item->id] = [
                'id' => $item->id,
                'url' => $item->getUrl(),
                'name' => $item->{$item->titleAttribute},
                'children' => (!$maxLevel || $item->level < $maxLevel) ? $this->tree($item, $maxLevel) : null,
            ];
        }

        return $tree;

    }
} 