<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_active')->checkbox() ?>
    <?php
    $items = [];
    $tabs = ['description','condition', 'result', 'applyment'];

    foreach ($tabs as $i => $tab) {
        $items[] = [
            'label' => Yii::t('app', $tab),
            'content' => $form->field($model, $tab)->widget(\yii\redactor\widgets\Redactor::className()),
            'active' => $i === 0
        ];
    }


    echo \yii\bootstrap\Tabs::widget([
        'items' => $items
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
