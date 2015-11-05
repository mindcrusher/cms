<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 01.03.2015
 * Time: 17:10
 */
use yii\widgets\ActiveForm;
use \app\modules\cart\CartAsset;


CartAsset::register($this);

$form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['/cart/checkout/index'],
]);

?>
<div class="row">
    <div class="col-sm-6">
        <?php
        echo $form->field($model, 'gender')->radioList(['Уважаемая','Уважаемый'])->label('Как к вам обращаться?');
        echo $form->field($model, 'firstname')->textInput();
        echo $form->field($model, 'middlename')->textInput();
        echo $form->field($model, 'surname')->textInput();
        echo $form->field($model, 'phone')->textInput();
        ?>
    </div>
    <div class="col-sm-6">
        <?php
        echo $form->field($model, 'zipcode')->textInput();
        echo $form->field($model, 'formatted_address')->textInput();
        echo $form->field($model, 'customer_comment')->textarea();
        echo \yii\helpers\Html::submitButton('Оформить',['class' => 'btn']);
        ?>
    </div>
</div>
<?php
ActiveForm::end();
?>