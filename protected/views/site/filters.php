<div class="form">
    <?php
    $model = $this->filterModel;
    $contr = in_array($this->id,array('site')) ? 'auctions' : $this->id;
    $form=$this->beginWidget('CActiveForm',
    array(
        'id' => 'lotSearchForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
        'enableAjaxValidation'=>true,
        'action' => $this->createUrl($contr."/".$this->action->id),
    ));
    
    if($this->id == "site"){
        echo $form->textField($model, 'searchText', array('class' => 'input-medium','prepend' => '<i class="icon-search"></i>', 'label' => false, 'placeholder' => "Search..."));
        echo CHtml::submitButton("New Lottery",CController::createUrl('auctions/create'), array('class' => 'btn btn-success')); 
        $cat = $model->lists['Categories'];
        ?>
        <?php foreach($cat as $k=>$item){ ?>
            <div class="panel panel-default bootstrap-widget-table">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo Yii::t('wonlot','Categories');?></h3>
                </div>
                <div class="panel-body">
                    <?php echo "<p>".CHtml::link($item, Yii::app()->createUrl('auctions/index/'.$item), array('label' => false))."</p>";?>
                </div>
            </div>
        <?php }
        
    } elseif($this->id == "auctions") { ?>
        <div class="form-block">
            <?php echo $form->textField($model, 'searchText', array('class' => 'input-medium','prepend' => '<i class="icon-search"></i>', 'label' => false, 'placeholder' => "Search...")); ?>
        </div>
        <?php if(!$model->mine){?>
            <div class="form-block">
                <?php echo $form->labelEx($model,'favorite');?>
                <?php echo $form->checkBox($model,'favorite'); ?>
            </div>
            <div class="form-block">
                <?php echo $form->labelEx($model,'onlyCompany');?>
                <?php echo $form->checkBox($model,'onlyCompany',array('class'=>'onlyOne')); ?>
                <?php echo $form->labelEx($model,'onlyPrivate');?>
                <?php echo $form->checkBox($model,'onlyPrivate',array('class'=>'onlyOne')); ?>
            </div>
            <div class="form-block">
                <?php echo $form->labelEx($model,'onlyNew');?>
                <?php echo $form->checkBox($model,'onlyNew',array('class'=>'onlyOne')); ?>
                <?php echo $form->labelEx($model,'onlyUsed');?>
                <?php echo $form->checkBox($model,'onlyUsed',array('class'=>'onlyOne')); ?>
            </div>
        <?php }?>
        <?php foreach($model->lists as $title=>$items){ ?>
            <div class="panel panel-default bootstrap-widget-table">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo Yii::t('wonlot',$title);?></h3>
                </div>
                <div class="panel-body checkbox-container small-row-scroll">
                    <?php echo $form->checkBoxList($model, $title, $items, array('label' => false)); ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-block">
            <?php
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
        ?>
        </div>
        <div class="form-block">
            <?php
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
        ?>
        </div>
        <div class="form-block-high">
            <?php
            $maxPrice = Auctions::model()->getMaxTicketPrice()+0; 
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
        </div>
        <?php if(!$model->mine){?>
            <div class="form-block">
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
            </div>
        <?php } ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton('Search', array('name' => 'search', 'class' => 'btn btn-success')); ?>
            <?php echo CHtml::submitButton('Reset', array('name' => 'reset', 'class' => 'btn btn-success')); ?>
        </div>        
    <?php } elseif($this->id == "users"){ ?>
        <div class="float-button" id="show-ticket-button">
            <span class="btn btn-primary glyphicon glyphicon-zoom-in" id="show-ticket-filter"><?php echo Yii::t('wonlot',"Ricerca");?></span>
        </div>
        <div id="ticket-search">
            <div class="float-button">
                <span class="btn btn-primary glyphicon glyphicon-zoom-out" id="hide-ticket-filter"><?php echo Yii::t('wonlot',"Chiudi");?></span>
                <?php 
                echo CHtml::ajaxButton ("Cerca",
                            CController::createUrl('users/searchTicket'), 
                            array('update' => '#user-tickets',
                                    'type' => 'POST', 
                                    'data'=>'js:$("#lotSearchForm").serialize()',
                            ),
                            array('class'=>"btn btn-success"));
                echo CHtml::ajaxButton ("Annulla",
                            CController::createUrl('users/searchTicket'), 
                            array('update' => '#user-tickets',
                                    'type' => 'POST', 
                                    'data'=>'js:[]',
                            ),
                            array('class'=>"btn btn-primary"));
                ?>
                
                
            </div>
            <div class="form-block row">
                <div class="col-md-3">
                    <?php echo $form->textField($model, 'searchText', array('class' => 'input-medium','prepend' => '<i class="icon-search"></i>', 'label' => false, 'placeholder' => "Search...")); ?>
                </div>
                <div class="col-md-3">
                <?php
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
                ?>
                </div>
                <div class="col-md-3">
                <?php
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
                ?>
                </div>
            </div>
            <div class="form-block row">
                <?php foreach($model->lists as $title=>$items){ ?>
                    <div class="col-md-3">
                        <div class="panel panel-default bootstrap-widget-table">
                            <div class="panel-heading">
                              <h3 class="panel-title"><?php echo Yii::t('wonlot',$title);?></h3>
                            </div>
                            <div class="panel-body checkbox-container small-row-scroll">
                                <?php echo $form->checkBoxList($model, $title, $items, array('label' => false)); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-3">
                    <?php
                        $maxPrice = Auctions::model()->getMaxTicketPrice()+0; 
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
                </div>
            </div>
            <div class="row buttons">
                
            </div>
        </div>

    <?php }  ?>
    <?php $this->endWidget(); ?>
</div>