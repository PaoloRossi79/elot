<?php
/* @var $this PrizeCategoriesController */
/* @var $model PrizeCategories */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'prize-categories-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_name'); ?>
		<?php echo $form->textField($model,'category_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'category_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_name'); ?>
		<?php echo $form->textField($model,'seo_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'seo_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->