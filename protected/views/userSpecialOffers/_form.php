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

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->activeHiddenField($model,'user_id'); ?>

	<div class="row">
            
		<?php 
                    $form->dropDownListRow(
                        $model,
                        'offer_on',
                        Yii::app()->params['specialOffersType']
                    );
                ?>
		<?php // echo $form->textFieldRow($profile, 'last_name', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
                
	</div>


	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'user_id'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offer_on'); ?>
		<?php echo $form->textField($model,'offer_on',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'offer_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offer_value'); ?>
		<?php echo $form->textField($model,'offer_value',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'offer_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'times_remaining'); ?>
		<?php echo $form->textField($model,'times_remaining'); ?>
		<?php echo $form->error($model,'times_remaining'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_modified_by'); ?>
		<?php echo $form->textField($model,'last_modified_by'); ?>
		<?php echo $form->error($model,'last_modified_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->