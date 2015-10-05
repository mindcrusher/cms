<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calc Modifications Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-modifications-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Calc Modifications Groups'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            array( 'attribute' => 'is_active' , 'value' => function($data){ return $data->is_active ? 'Да' : 'Нет';}),
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
