<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */
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
		<?php echo $form->label($model,'nl_type'); ?>
		<?php echo $form->textField($model,'nl_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nl_type_id'); ?>
		<?php echo $form->textField($model,'nl_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
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

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_ip'); ?>
		<?php echo $form->textField($model,'sub_ip',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sub_dns'); ?>
		<?php echo $form->textField($model,'sub_dns',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term_cond'); ?>
		<?php echo $form->textField($model,'term_cond'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'privacy_ok'); ?>
		<?php echo $form->textField($model,'privacy_ok'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'n_msg_sent'); ?>
		<?php echo $form->textField($model,'n_msg_sent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->