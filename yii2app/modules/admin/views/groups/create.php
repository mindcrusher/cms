<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CalcModificationsGroups */

$this->title = Yii::t('app', 'Create Calc Modifications Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modifications Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-modifications-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
