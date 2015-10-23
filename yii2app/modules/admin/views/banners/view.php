<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-view">



    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'photo_id',
                'value' => empty($model->file) ? '' : Html::img($model->file->src, ['width' => '250']),
                'format' => 'raw'
            ],
            'url:url',
            [
                'attribute' => 'html',
                'format' => 'raw',
            ],
            'begin_time',
            'end_time',
            [
                'attribute' => 'is_active',
                'value' => \app\components\Helper::boolLabel($model)
            ],
        ],
    ]) ?>

</div>
