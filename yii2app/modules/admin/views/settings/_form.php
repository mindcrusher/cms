<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CalcSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calc-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base_tax_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_options_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calc_header')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'cost_header')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'calc_note')->textInput(['maxlength' => true])->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
