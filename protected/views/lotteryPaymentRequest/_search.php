<?php
/* @var $this LotteryPaymentRequestController */
/* @var $model LotteryPaymentRequest */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lottery_id'); ?>
		<?php echo $form->textField($model,'lottery_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'from_user_id'); ?>
		<?php echo $form->textField($model,'from_user_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sent_date'); ?>
		<?php echo $form->textField($model,'sent_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_completed'); ?>
		<?php echo $form->textField($model,'is_completed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complete_date'); ?>
		<?php echo $form->textField($model,'complete_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complete_by'); ?>
		<?php echo $form->textField($model,'complete_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complete_ref'); ?>
		<?php echo $form->textField($model,'complete_ref',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->