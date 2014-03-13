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
            'htmlOptions' => array('class' => 'well','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
?>
<fieldset>
 
    <legend><?php echo Yii::t('wonlot','Give Special Offer');?></legend>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'user_id'); ?>

	    
        <?php 
            $offersType = array();
            foreach(Yii::app()->params['specialOffersType'] as $k=>$ot){
                $offersType[$k] = $ot['name']; 
            }
            echo $form->dropDownList(
                $model,
                'offer_on',
                $offersType
            );
        ?>
         <?php echo $form->textField($model,'offer_value', 
                 array(
                     'hint' => Yii::t('wonlot','Percentage of discoutn: ie -40%'),
                     'prepend' => ' - ',
                     'append' => ' % ',
                     )); ?>

        <?php echo $form->textField($model,'comment'); ?>

        <?php 
        echo $form->labelEx($model,'start_date');
        $this->widget(
            'zii.widgets.jui.CJuiDatePicker',
            array(
                'id' => 'offer_start',
                'model' => $model,
                'attribute' => 'start_date',
                'htmlOptions' => array(
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
                        $("#offer_end").datepicker("option","minDate",selDate);
                    }',
                )
            )
        );
        ?>

        <?php 
        echo $form->labelEx($model,'end_date');
        $this->widget(
            'zii.widgets.jui.CJuiDatePicker',
            array(
                'id' => 'offer_end',
                'model' => $model,
                'attribute' => 'end_date',
                'htmlOptions' => array(
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
                        $("#offer_start").datepicker("option","minDate",selDate);
                    }',
                )
            )
        );
        ?>

        <?php echo $form->textField($model,'times_remaining'); ?>
	
	<div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('wonlot','Search'), array('name' => 'search', 'class' => 'btn')); ?>
            <?php echo CHtml::resetButton(Yii::t('wonlot','Reset')) ?>
        </div>
</fieldset>

<?php $this->endWidget(); ?>