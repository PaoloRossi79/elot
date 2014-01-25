<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */
/* @var $form CActiveForm */
?>

<?php 
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
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
            echo $form->dropDownListRow(
                $model,
                'offer_on',
                $offersType
            );
        ?>
         <?php echo $form->textFieldRow($model,'offer_value', 
                 array(
                     'hint' => Yii::t('wonlot','Percentage of discoutn: ie -40%'),
                     'prepend' => ' - ',
                     'append' => ' % ',
                     )); ?>

        <?php echo $form->textFieldRow($model,'comment'); ?>

        <?php 
        echo $form->labelEx($model,'start_date');
        $this->widget(
            'bootstrap.widgets.TbDatePicker',
            array(
                'name' => 'startDate',
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
                )
            )
        );
        ?>

        <?php 
        echo $form->labelEx($model,'end_date');
        $this->widget(
            'bootstrap.widgets.TbDatePicker',
            array(
                'name' => 'endDate',
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
                )
            )
        );
        ?>

        <?php echo $form->textFieldRow($model,'times_remaining'); ?>
	
	<div class="form-actions">
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'label' => Yii::t('wonlot','Give Offer!'),
                )
            ); ?>
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array('buttonType' => 'reset', 'label' => 'Reset')
            ); ?>
        </div>
</fieldset>

<?php $this->endWidget(); ?>