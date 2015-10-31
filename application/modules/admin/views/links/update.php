<?php

/* @var $this yii\web\View */
/* @var $model app\models\Links */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Links',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="links-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
