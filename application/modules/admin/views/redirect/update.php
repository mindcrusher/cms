<?php

/* @var $this yii\web\View */
/* @var $model app\models\RedirectRules */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Redirect Rules',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Redirect Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="redirect-rules-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>