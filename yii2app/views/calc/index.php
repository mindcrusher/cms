<?php
use yii\bootstrap\ActiveForm;
$this->title = $settings->calc_header;
$this->registerJsFile('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
$this->registerJsFile('/calc/js/app.js');
$form = ActiveForm::begin([
        'id' => 'calcForm',
        'action' => \yii\helpers\Url::to('site/calculate')
    ]
);
?>
<div class="col-sm-12">
    <h1 style="font-weight:bold"><?=$settings->calc_header?></h1>    
        <div class="row">
        
            <div class="col-sm-12">
                <h2 id="base_tax"><?=$settings->base_tax_text?></h2>
                <?php foreach( $modes as $i => $mode) {?>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input class="radio-button" type="radio" name="mode" id="mode_<?=$i?>" value="<?=$mode->id?>" />
                            <?=$mode->name?>
                        </label>
                    </div>
                <?php } ?>
                
            </div>
        </div>
        <div id='options' class="row">
        <?php foreach($modifications as $group) { ?>
                
            <div class="col-sm-6 modifications">
                <div class="form-group">
                    <h3><?=$group->title?></h3>
                    <?php foreach($group->calcModifications as $i => $mod) {?>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="mod[<?=$group->id?>]" id="mod_<?=$i?>" value="<?=$mod->id?>" />
                                <?=$mod->title?>
                            </label>
                        </div>
                    <?php }?>
                </div>

            </div>
        <?php } ?>
       </div>
    <div class="row">
        
        <div class="col-sm-12">
            <div class="form-group">
                <span id="show-options" data-toggle-text="<?=$settings->hide_options_text?>" class="dotted pointer "><?=$settings->show_options_text?></span>
            </div>
            <div class="row">
            
                <div class='col-sm-3'>
                    <?php echo \yii\helpers\Html::submitButton('Рассчитать', [
                                        'class' => 'btn btn-lg btn-primary', 
                                        'id' => 'calc',
                                        'disabled' => 'disabled',
                                    ]); ?>
                </div>
                <div class='col-sm-6'>
                    <div id='preloader' class='hide'><img src="/calc/img/ajax-loader.gif"/></div>
                    <div id="ajaxResult"></div>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-9 hide pull-right' id="success">
                    <?=$settings->calc_note?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>