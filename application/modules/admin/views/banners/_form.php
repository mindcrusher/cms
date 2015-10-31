<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Files;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */
/* @var $form yii\widgets\ActiveForm */
$file = new Files;
?>

<div class="banners-form">
    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($file, 'file')->fileInput() ?>



            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'html')->widget(\yii\redactor\widgets\Redactor::className()) ?>

            <?= $form->field($model, 'is_active')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6"><?= !empty($model->file) ? Html::img($model->file->src) : ''; ?></div>
    </div>
</div>
