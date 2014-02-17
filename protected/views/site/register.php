<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Register',
);
?>

<h1>Register</h1>

<p>Please fill out the following form with your register credentials:</p>
<div class="panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo Yii::t('wonlot','Register');?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
        <?php $form=$this->beginWidget('CActiveForm'); ?>

                <p class="note">Fields with <span class="required">*</span> are required.</p>

                <div class="row">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email'); ?>
                        <?php echo $form->error($model,'email'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'confirm email'); ?>
                        <?php echo $form->textField($model,'confirmEmail'); ?>
                        <?php echo $form->error($model,'confirmEmail'); ?>
                </div>

                <div class="row">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password'); ?>
                        <?php echo $form->error($model,'password'); ?>
        <!--		<p class="hint">
                                Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                        </p>-->
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'confirm password'); ?>
                        <?php echo $form->passwordField($model,'confirmPassword'); ?>
                        <?php echo $form->error($model,'confirmPassword'); ?>
        <!--		<p class="hint">
                                Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                        </p>-->
                </div>

                <div class="row rememberMe">
                        <?php echo $form->checkBox($model,'terms'); ?>
                        <?php echo $form->label($model,'Accept terms & cond?'); ?>
                        <?php echo $form->error($model,'terms'); ?>
                </div>
                <div class="row rememberMe">
                        <?php echo $form->checkBox($model,'persdatamng'); ?>
                        <?php echo $form->label($model,'Accept pers data managment?'); ?>
                        <?php echo $form->error($model,'persdatamng'); ?>
                </div>

                <div class="row buttons">
                        <?php echo CHtml::submitButton('Register'); ?>
                </div>

        <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>