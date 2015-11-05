<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 02.03.2015
 * Time: 21:04
 */
use \app\modules\cart\Asset;
use \yii\helpers\Url;
use \yii\helpers\Json;

Asset::register($this);
$cart = \app\modules\cart\controllers\DefaultController::cartState();
$js = 'var cartUrl = "' . Url::to('/cart/api/') . '"; var cartState = '.Json::encode($cart).';';
$this->registerJS($js, \yii\web\View::POS_HEAD );
$visible = true;
if($visible) {
?>
<script id="cart__widget-template-state" type="text/template">
	<div class='row'>
		<div class="col-sm-4">
			<b><a href="<?=Url::to(['/cart/default/index'])?>">Ваша корзина:</a></b>
		</div>
		<div class="col-sm-4">
			<b>Товаров:</b> <span class="cart__control cart__widget-cost"><%= count %></span>
		</div>
		<div class="col-sm-4">
			<span class="cart__control cart__widget-cost"><%= cost %></span> руб.
		</div>
    </div>
</script>
<script id="cart__widget-template-item" type="text/template">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-8"><%= title %></div>
            <div class="col-xs-1">
                <span class="cart__control cart__control-decrease glyphicon glyphicon-minus-sign"></span>
            </div>
            <div class="col-xs-1">
                <div class="cart__control-qty">
                    <%= quantity %>
                </div>
            </div>
            <div class="col-xs-1">
                <span class="text-right cart__control cart__control-increase glyphicon glyphicon-plus-sign"></span>
            </div>
            <div class="col-xs-1 text-center">
                <span data-id="<%= id %>" class="glyphicon glyphicon-trash cart__control cart__control-delete"></span>
            </div>
        </div>
    </div>
</script>
<div class="cart__widget">
    <div class="cart__widget-state"></div>
	<div class="cart__widget-info">

		<div class="cart__widget-items"></div>
	</div>
</div>
<?php 
}
?>