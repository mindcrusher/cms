<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = Yii::t('app', 'Add');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
