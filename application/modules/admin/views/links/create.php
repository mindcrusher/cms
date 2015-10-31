<?php

/* @var $this yii\web\View */
/* @var $model app\models\Links */

$this->title = Yii::t('app', 'Create Links');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
