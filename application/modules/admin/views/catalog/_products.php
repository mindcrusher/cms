<?php
use kartik\form\ActiveForm;
use \yii\helpers\Html;

if(!$model->isNewRecord) {
    $relModel->category_id = $model->id;
    $form = ActiveForm::begin(['action' => ['/cms/catalog/link-product']]);
?>
    <h4>Добавление товаров</h4>
    <div class="hidden">
        <?php
        echo $form->field($relModel,'category_id')->hiddenInput();
        ?>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <?php
            echo $form->field($relModel, 'product_id')->widget(\yii\jui\AutoComplete::classname(), [
                'clientOptions' => [
                    'source' => $model->getFreeProducts(),
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Начните вводить название'
                ]
            ]);
            ?>
        </div>
        <div class="col-sm-2">
            <?php
            echo Html::submitButton(Yii::t('app','Add'), ['class' => 'btn btn-primary', 'style' => 'margin-top:25px;width:100%;']);
            ?>
        </div>
    </div>
    <?php
    ActiveForm::end();
}
?>