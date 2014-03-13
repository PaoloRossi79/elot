<?php
/* @var $this UsersController */
/* @var $model Users */
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
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_type_id'); ?>
		<?php echo $form->textField($model,'user_type_id',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	

	<div class="row">
		<?php echo $form->label($model,'cookie_hash'); ?>
		<?php echo $form->textField($model,'cookie_hash',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cookie_time_modified'); ?>
		<?php echo $form->textField($model,'cookie_time_modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_agree_terms_conditions'); ?>
		<?php echo $form->textField($model,'is_agree_terms_conditions'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_agree_personaldata_management'); ?>
		<?php echo $form->textField($model,'is_agree_personaldata_management'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_email_confirmed'); ?>
		<?php echo $form->textField($model,'is_email_confirmed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signup_ip'); ?>
		<?php echo $form->textField($model,'signup_ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_login_ip'); ?>
		<?php echo $form->textField($model,'last_login_ip',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_logged_in_time'); ?>
		<?php echo $form->textField($model,'last_logged_in_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'available_balance_amount'); ?>
		<?php echo $form->textField($model,'available_balance_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dns'); ?>
		<?php echo $form->textField($model,'dns',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wallet_value_bonus'); ?>
		<?php echo $form->textField($model,'wallet_value_bonus'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->