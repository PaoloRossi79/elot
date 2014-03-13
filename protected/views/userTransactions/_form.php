<?php
/* @var $this UserTransactionsController */
/* @var $model UserTransactions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'user-transactions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_type'); ?>
		<?php echo $form->textField($model,'transaction_type'); ?>
		<?php echo $form->error($model,'transaction_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_ref_id'); ?>
		<?php echo $form->textField($model,'transaction_ref_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'transaction_ref_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_confirmed'); ?>
		<?php echo $form->textField($model,'is_confirmed'); ?>
		<?php echo $form->error($model,'is_confirmed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'promotion_id'); ?>
		<?php echo $form->textField($model,'promotion_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'promotion_id'); ?>
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