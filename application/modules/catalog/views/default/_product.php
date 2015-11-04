<?php
$product = $model->product;
?>
<div class="col-sm-4 product">
    <a href="<?=$product->getUrl()?>">
        <figure class="row">
            <div class="image col-sm-12">
                <?=\yii\bootstrap\Html::img($product->mainPhoto()->src)?>
            </div>
            <div class="col-sm-12 h5"><?=$product->title?></div>
        </figure>
    </a>
</div>