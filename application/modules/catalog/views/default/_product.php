<?php
$product = $model->product;
?>
<div class="col-sm-4 product">
    <a href="<?=$product->getUrl()?>">
        <figure class="row">
            <div class="image col-sm-12">
                <?=\yii\bootstrap\Html::img($product->mainPhoto()->src)?>
            </div>
            <div class="description col-sm-12"><?=$product->title?></div>
            <?php
            echo app\modules\cart\widgets\FastAdd::widget(['product' => $product]);
            ?>
        </figure>
    </a>
</div>