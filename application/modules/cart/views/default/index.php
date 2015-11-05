<?php

use \yii\helpers\Html;
use \app\modules\cart\MainAsset;

echo Html::a('Оформить заказ',['/cart/checkout/index']);
MainAsset::register($this);
?>
<script id="cart__main-template-state" type="text/template">
	<div class='row'>
		<div class="col-sm-6">
			Всего товаров: <%= count %>
		</div>
		<div class="col-sm-6">
			На сумму:  <span class="cart__control cart__widget-cost"><%= cost %></span>руб.
		</div>
    </div>
</script>
<div class="cart__main">
    <div class="cart__main-items"></div>
    <div class="cart__main-state"></div>
</div>