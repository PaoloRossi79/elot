<div class="form">
    <?php
    $model = $this->filterModel;
    $contr = in_array($this->id,array('site')) ? 'lotteries' : $this->id;
    $form=$this->beginWidget('CActiveForm',
    array(
        'id' => 'lotSearchForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
        'enableAjaxValidation'=>true,
        'action' => $this->createUrl($contr.'/index'),
    ));
    echo $form->textField($model, 'searchText', array('class' => 'input-medium','prepend' => '<i class="icon-search"></i>', 'label' => false, 'placeholder' => "Search..."));
    if($this->id == "site"){
        echo CHtml::submitButton("New Lottery",CController::createUrl('lotteries/create'),array('class'=>'btn')); 
        $cat = $model->lists['Categories'];
        ?>
        <?php foreach($cat as $k=>$item){ ?>
            <div class="panel panel-default bootstrap-widget-table">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo Yii::t('wonlot','Categories');?></h3>
                </div>
                <div class="panel-body">
                    <?php echo "<p>".CHtml::link($item, Yii::app()->createUrl('lotteries/index/'.$item), array('label' => false))."</p>";?>
                </div>
            </div>
        <?php }
        
    } elseif($this->id == "lotteries") {
        foreach($model->lists as $title=>$items){ ?>
            <div class="panel panel-default bootstrap-widget-table">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo Yii::t('wonlot',$title);?></h3>
                </div>
                <div class="panel-body">
                    <?php echo $form->checkBoxList($model, $title, $items, array('label' => false)); ?>
                </div>
            </div>
        <?php
        }
        echo $form->labelEx($model,'searchStartDate');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'id' => 'search_start',
                'model' => $model,
                'attribute' => 'searchStartDate',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    'class' => 'input-medium',
                ),
                'options' => array(
                    'language' => 'it',
                    'dateFormat'=>'dd/mm/yy',
                    //'dateFormat'=>'yy-mm-dd',
                    'timeFormat'=>'HH:mm:ss',
                    'showSecond'=>true,
                    'showTimezone'=>false,
                    'ampm' => false,
                    'onSelect'=>'js:function(selDate,obj){
                        $("#search_end").datepicker("option","minDate",selDate);
                    }',
                )
            )
        );
        echo $form->labelEx($model,'searchEndDate');
        $this->widget(
            'zii.widgets.jui.CJuiDatePicker',
            array(
                'id' => 'search_end',
                'model' => $model,
                'attribute' => 'searchEndDate',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    'class' => 'input-medium',
                ),
                'options' => array(
                    'language' => 'it',
                    'dateFormat'=>'dd/mm/yy',
                    //'dateFormat'=>'yy-mm-dd',
                    'timeFormat'=>'HH:mm:ss',
                    'showSecond'=>true,
                    'showTimezone'=>false,
                    'ampm' => false,
                    'onSelect'=>'js:function(selDate,obj){
                        $("#search_start").datepicker("option","minDate",selDate);
                    }',
                )
            )
        );
        $maxPrice = Lotteries::model()->getMaxTicketPrice()+0; 
        $model->minTicketPriceRange=$model->minTicketPriceRange+0; // Trick to format decimals
        $model->maxTicketPriceRange=$model->maxTicketPriceRange+0;
        if(!$model->minTicketPriceRange){
            $model->minTicketPriceRange=0;
        }
        if(!$model->maxTicketPriceRange){
            $model->maxTicketPriceRange=$maxPrice;
        }
        echo $form->labelEx($model,'ticketPrice'); ?>
        <input type="text" class="input-medium" id="ticket-price-range" value="<?php echo $model->minTicketPriceRange . " - " . $model->maxTicketPriceRange;?>" style="border:0; color:#f6931f; font-weight:bold;" />
        <?php
        $this->widget('zii.widgets.jui.CJuiSliderInput', array(
            'name'=>'ticket_price_slider',    
            'event'=>'change',
            'model'=>$model,
            'attribute'=>'minTicketPriceRange',
            'maxAttribute'=>'maxTicketPriceRange',
            'options'=>array(
    //            'values'=>array((int)$model->minPriceRange,(int)$model->maxPriceRange),// default selection
    //            'values'=>array(2,5),// default selection
                'min'=>0, //minimum value for slider input
                'max'=>$maxPrice, // maximum value for slider input
                'animate'=>true,
                'range'=>true,
                'step'=>0.5,
                // on slider change event
                'slide'=>'js:function(event,ui){
                    $("#ticket-price-range").val(ui.values[0]+\'-\'+ui.values[1]);
                }',
            ),
            // slider css options
            'htmlOptions'=>array(
                'class'=>'input-medium'
            ),
        ));
        ?>

        <?php 
        $maxPrize = Lotteries::model()->getMaxPrizePrice()+0; 
        $model->minPrizePriceRange=$model->minPrizePriceRange+0; // Trick to format decimals
        $model->maxPrizePriceRange=$model->maxPrizePriceRange+0;
        if(!$model->minPrizePriceRange){
            $model->minPrizePriceRange=0;
        }
        if(!$model->maxPrizePriceRange){
            $model->maxPrizePriceRange=$maxPrize;
        }
        ?>
        <?php echo $form->labelEx($model,'prizePrice'); ?>
        <input type="text" class="input-medium" id="prize-price-range"  value="<?php echo $model->minPrizePriceRange . " - " . $model->maxPrizePriceRange;?>" style="border:0; color:#f6931f; font-weight:bold;" />
        <?php
        $this->widget('zii.widgets.jui.CJuiSliderInput', array(
            'name'=>'prize_price_slider',    
            'event'=>'change',
            'model'=>$model,
            'attribute'=>'minPrizePriceRange',
            'maxAttribute'=>'maxPrizePriceRange',
            'options'=>array(
    //            'values'=>array((int)$model->minPriceRange,(int)$model->maxPriceRange),// default selection
    //            'values'=>array(2,5),// default selection
                'min'=>0, //minimum value for slider input
                'max'=>$maxPrize, // maximum value for slider input
                'animate'=>true,
                'range'=>true,
                'step'=>  round(($model->minPrizePriceRange - $model->maxPrizePriceRange) / 10),
                // on slider change event
                'slide'=>'js:function(event,ui){
                    $("#prize-price-range").val(ui.values[0]+\'-\'+ui.values[1]);
                }',
            ),
            // slider css options
            'htmlOptions'=>array(
                'class'=>'input-medium'
            ),
        ));
        ?>
        <?php echo $form->labelEx($model,'geo'); ?>
        <?php 
        /* http://www.yiiframework.com/extension/egmap/ */
        $this->widget('gmap.EGMapAutocomplete', array(
            'name' => 'city',
            'model' => $model,
            'value' => $model->geo,
            'attribute' => 'geo',
            'htmlOptions'=>array(
                'class'=>'input-medium'
            ),
            'options' => array(
               'types' => array(
                 '(cities)'
               ),
               /*'componentRestrictions' => array(
                  'country' => 'us',
                )*/
            )
        ));
        ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Search', array('name' => 'search', 'class' => 'btn')); ?>
            <?php echo CHtml::submitButton('Reset', array('name' => 'reset', 'class' => 'btn')); ?>
        </div>        
    <?php } ?>
    <?php $this->endWidget(); ?>
</div>