<?php
$product = $model->product;
?>
<div class="col-sm-3">
    <a href="<?=$product->getUrl()?>">
        <figure>
            <span class="h3"><?=$product->title?></span>
        </figure>
    </a>
</div>