<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 31.10.2015
 * Time: 10:50
 */
?>
<div class="row">
    <div class="col-sm-4">
        <?php
        if($model->hasPhotos()) {
            echo \yii\bootstrap\Html::img($model->mainPhoto()->src);
            foreach($model->photos as $photo) {
                echo \yii\bootstrap\Html::a('', $photo->file->src);
            }
        }

        ?>
    </div>
    <div class="col-sm-8">
        <h1><?=$model->title?></h1>
        <div class="row">
            <div class="col-xs-6 text-right">Цена:</div>
            <div class="col-xs-6 text-left">
                <?=$model->price?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php
        $items = [];
        $tabs = ['description','condition', 'result', 'applyment'];

        foreach ($tabs as $i => $tab) {
            $items[] = [
                'label' => Yii::t('app', $tab),
                'content' => $model->$tab,
                'active' => $i === 0
            ];
        }


        echo \yii\bootstrap\Tabs::widget([
            'items' => $items
            ]);
        ?>
    </div>
</div>