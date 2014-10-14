<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */
/* @var $form CActiveForm */
?>

<?php 
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userOffers-form',
            'htmlOptions' => array('class' => 'well form-horizontal','enctype' => 'multipart/form-data', 'role' => 'form'), // for inset effect
        )
    );
?>
<fieldset>
 
    <legend><?php echo Yii::t('wonlot','Attiva offerta speciale per: ').$user->username;?></legend>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'user_id'); ?>

<!--        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>-->
        <div class="form-group">
            <?php echo $form->labelEx($model,'offer_on',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php 
                $offersType = array();
                foreach(Yii::app()->params['specialOffersType'] as $k=>$ot){
                    $offersType[$k] = $ot['name']; 
                }
                echo $form->dropDownList(
                    $model,
                    'offer_on',
                    $offersType,
                    array('class'=>' form-control')
                );
            ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'offer_value',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">-</span>
                    <?php echo $form->textField($model,'offer_value', 
                     array(
                         'placeholder' => Yii::t('wonlot','Percentage of discount: ie -40%'),
                         'class'=>' form-control'
                         )); ?>
                    <span class="input-group-addon">%</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'comment',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'comment',array('class'=>' form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'start_date',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php 
                $this->widget(
                    'zii.widgets.jui.CJuiDatePicker',
                    array(
                        'id' => 'offer_start',
                        'model' => $model,
                        'attribute' => 'start_date',
                        'htmlOptions' => array(
                            'class' => 'input-medium form-control',
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
                                $("#offer_end").datepicker("option","minDate",selDate);
                            }',
                        )
                    )
                );
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'end_date',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php 
                $this->widget(
                    'zii.widgets.jui.CJuiDatePicker',
                    array(
                        'id' => 'offer_end',
                        'model' => $model,
                        'attribute' => 'end_date',
                        'htmlOptions' => array(
                            'class' => 'input-medium form-control',
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
                                $("#offer_start").datepicker("option","minDate",selDate);
                            }',
                        )
                    )
                );
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'times_remaining',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'times_remaining',array('class'=>' form-control')); ?>
            </div>
        </div>
        
	<div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('wonlot','Salva'), array('name' => 'search', 'class' => 'btn btn-success')); ?>
            <?php echo CHtml::resetButton(Yii::t('wonlot','Cancella'), array( 'class' => 'btn btn-danger')) ?>
        </div>
</fieldset>

<?php $this->endWidget(); ?>