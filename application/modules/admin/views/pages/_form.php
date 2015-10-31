<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12">
        <div class="row pull-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#page" aria-controls="page" role="tab" data-toggle="tab">Основное</a></li>
        <li role="presentation"><a href="#body" aria-controls="seo" role="tab" data-toggle="tab">Текст</a></li>
        <li role="presentation"><a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">SEO</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="page">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
        </div>
        <div id="body" role="tabpanel" class="tab-pane" >
            <?= $form->field($model, 'text')->widget(\yii\redactor\widgets\Redactor::className()) ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="seo">
            <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?>

        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
