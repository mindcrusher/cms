<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\CalcModificationsGroups;

/* @var $this yii\web\View */
/* @var $model app\models\CalcModifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calc-modifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')
        ->textInput()
        ->dropDownList(
            ArrayHelper::map(
                CalcModificationsGroups::findAll(['is_active' => 1])
                ,'id','title'),
                ['prompt' => 'Выберите']
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mode_factor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
