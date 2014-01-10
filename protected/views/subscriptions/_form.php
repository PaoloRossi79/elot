<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscriptions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nl_type'); ?>
		<?php echo $form->textField($model,'nl_type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nl_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nl_type_id'); ?>
		<?php echo $form->textField($model,'nl_type_id'); ?>
		<?php echo $form->error($model,'nl_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_ip'); ?>
		<?php echo $form->textField($model,'sub_ip',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'sub_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sub_dns'); ?>
		<?php echo $form->textField($model,'sub_dns',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'sub_dns'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term_cond'); ?>
		<?php echo $form->textField($model,'term_cond'); ?>
		<?php echo $form->error($model,'term_cond'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'privacy_ok'); ?>
		<?php echo $form->textField($model,'privacy_ok'); ?>
		<?php echo $form->error($model,'privacy_ok'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'n_msg_sent'); ?>
		<?php echo $form->textField($model,'n_msg_sent'); ?>
		<?php echo $form->error($model,'n_msg_sent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->