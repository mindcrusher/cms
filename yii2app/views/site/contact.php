<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'ОБРАТНАЯ СВЯЗЬ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Спасибо, что написали нам! Мы свяжемся с Вами в ближайшее время.
    </div>

    <?php else: ?>
    <div>
<div><span><span >Здесь Вы можете задать в режиме ОН-ЛАЙН интересующие Вас вопросы, написать пожелания и предложения, оставить комментарии, а также оценить работу сотрудников </span></span></span><strong><span ><a href="http://taggerd.su/"><span><span >ЧОП&nbsp;"ТАГГЕРД" (Москва)</span></span></a></span></strong><span><strong><span >. </span></strong><span >При желании Вы можете связаться с нами по телефону</span><strong><span > <span><span>(495) 78-262-87</span></span> </span></strong><span >(ежедневно, с 9.00 до 22.00). <br>
</span></span></span></div>
<div><span><span >Письмо можно продублировать по электронному адресу:</span><strong><span > taggerd@mail.ru </span></strong></span></span></div>
<div><span>&nbsp;</span></span></div>
<div><span><strong><span >НЕ&nbsp;ЗАБУДЬТЕ оставить адрес электронной почты и контактный телефон для связи с Вами.</span></strong></span></span></div>
<div>&nbsp;</div>
</div>
    <div class="row">
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php endif; ?>
</div>
