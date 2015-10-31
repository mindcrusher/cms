<?php
$product = $model->product;
?>
<div class="col-sm-4">
    <a style="height: 300px;display: block;" href="<?=$product->getUrl()?>">
        <figure>
            <?=\yii\bootstrap\Html::img($product->mainPhoto()->file->src)?>
            <span class="h2"><?=$product->title?></span>
        </figure>
    </a>
</div>