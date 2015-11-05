<?php
use yii\helpers\Html;
?>
<div class="form-group">
    <div class="col-sm-4 col-xs-12">
        &nbsp;
    </div>
    <div class="col-sm-8 col-xs-12">
        <div class="row">
            <div class="col-sm-4 text-right">
                <span class="cart__control cart__control-decrease glyphicon glyphicon-minus-sign"></span>
            </div>
            <div class="col-sm-4">
                <div class="cart__control-qty">
                    <input type="text" class="form-control input-sm cart__widget-control-qty" maxlength="3" value="1"/>
                </div>
            </div>
            <div class="col-sm-4">
                <span class="text-right cart__control cart__control-increase glyphicon glyphicon-plus-sign"></span>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-4 col-xs-12">
        &nbsp;
    </div>
    <div class="col-sm-8 col-xs-12">
        <div class="row">
            <div class="col-xs-2">
                <?php
                echo Html::a('Добавить в корзину',
                    [
                        '/cart/default/do',
                        'offer_id' => $offer->id,
                        'quantity' => 1,
                        'action' => 'add',
                    ],
                    [
                        'class' => \app\modules\cart\widgets\Add::CSS_MANAGE_CLASS,
                        'data-offer_id' => $offer->id
                    ]
                );
                ?>
            </div>
        </div>
    </div>
</div>