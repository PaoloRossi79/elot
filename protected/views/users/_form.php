<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <?php if(Yii::app()->user->isAdmin()){ ?>
            <div class="row">
                    <?php echo $form->labelEx($model,'user_type_id'); ?>
                    <?php echo $form->dropDownList($model,'user_type_id',array_flip(Yii::app()->user->userTypes)); ?>
                    <?php echo $form->error($model,'user_type_id'); ?>
            </div>
        <?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_agree_terms_conditions'); ?>
		<?php echo $form->checkBox($model,'is_agree_terms_conditions'); ?>
		<?php echo $form->error($model,'is_agree_terms_conditions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_agree_personaldata_management'); ?>
		<?php echo $form->checkBox($model,'is_agree_personaldata_management'); ?>
		<?php echo $form->error($model,'is_agree_personaldata_management'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->