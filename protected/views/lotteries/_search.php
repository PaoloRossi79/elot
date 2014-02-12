<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lottery_type'); ?>
		<?php echo $form->textField($model,'lottery_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_desc'); ?>
		<?php echo $form->textField($model,'prize_desc',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_category'); ?>
		<?php echo $form->textField($model,'prize_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_img'); ?>
		<?php echo $form->textField($model,'prize_img',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_conditions'); ?>
		<?php echo $form->textField($model,'prize_conditions',array('size'=>60,'maxlength'=>155)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_shipping'); ?>
		<?php echo $form->textField($model,'prize_shipping',array('size'=>60,'maxlength'=>155)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prize_shipping_charges'); ?>
		<?php echo $form->textField($model,'prize_shipping_charges'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'min_ticket'); ?>
		<?php echo $form->textField($model,'min_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_ticket'); ?>
		<?php echo $form->textField($model,'max_ticket'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ticket_value'); ?>
		<?php echo $form->textField($model,'ticket_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lottery_start_date'); ?>
		<?php echo $form->textField($model,'lottery_start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lottery_draw_date'); ?>
		<?php echo $form->textField($model,'lottery_draw_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_modified_by'); ?>
		<?php echo $form->textField($model,'last_modified_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->