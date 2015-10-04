<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CalcModifications */

$this->title = Yii::t('app', 'Create Calc Modifications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-modifications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
