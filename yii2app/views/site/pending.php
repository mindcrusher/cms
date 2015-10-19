<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Заявка на услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('pendingFormSubmitted')): ?>

    <div class="alert alert-success">
        Заявка отправлена
    </div>

    <?php else: ?>

    <div class="row">
        <div class="col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'pending-form']); ?>
                <?= $form->field($model, 'contact_name')->textInput([
                        'placeholder' => 'Юридическое лицо (Название) / Физическое лицо (ФИО)'
                ]); ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone')->textInput([
                    'placeholder' => '89261234556'
                ]) ?>
                <?= $form->field($model, 'address')->textInput([
                    'placeholder' => 'г. Москва, ул. адмирала Удальцова 14'
                ]) ?>
                <?= $form->field($model, 'protection_object')->textArea([
                    'rows' => 6,
                    'placeholder' => 'Магазин, склад, завод, офис, ресторан, коттедж, школа и т.п.'
                ]) ?>
                <?= $form->field($model, 'services_list')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'requirements') ?>
                <?= $form->field($model, 'space') ?>
                <?= $form->field($model, 'protection_systems') ?>
                <?= $form->field($model, 'payment_conditions') ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-sm-3">{image}</div><div class="col-sm-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'pending-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
