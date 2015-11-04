<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 04.11.2015
 * Time: 13:18
 */
$product = $model->product;
?>
<div class="col-sm-4 handle">
    <div class="actions-panel">
        <a href="<?=\yii\helpers\Url::to(['/cms/catalog/unlink-product', 'id' => $model->id])?>" class="glyphicon glyphicon-trash remove-product-link">

        </a>&nbsp;
        <a href="<?=\yii\helpers\Url::to(['/cms/catalog/hide-product', 'id' => $model->id])?>" class="glyphicon glyphicon-eye-<?=$model->is_active ? 'open' : 'close'?> pull-right">

        </a>
    </div>
    <div class="wrapper is_<?=$model->is_active ? 'open' : 'closed'?>">
        <div>
            <?=\yii\helpers\Html::img($product->mainPhoto()->src)?>
        </div>
        <span class="h5"><?=$product->title?></span>
    </div>
</div>