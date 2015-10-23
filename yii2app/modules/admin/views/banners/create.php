<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Banners */

$this->title = Yii::t('app', 'Create Banners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
