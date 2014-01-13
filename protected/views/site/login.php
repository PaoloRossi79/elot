<div class="form login-panel <?php echo ($showLogin ? "show-login" : "hide-login"); ?>" >
    <?php
    $model = new LoginForm;
    if($afterLogin && !$authenticated) {
        $model->addError('password', 'Authentication Error');
    }
    if($this->getAction()->getId() !== "error"){
        $model->originUrl = $this->getId() . '/' . $this->getAction()->getId();
    }
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user_login_form',
        'enableAjaxValidation'=>true,
        'action' => $this->createUrl('site/login'),
        
    )); 
    ?>

	<div class="row" id="loginForm">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
                <?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
                <?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
		<?php echo $form->hiddenField($model,'originUrl'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton(
                        Yii::t('app', 'Submit'), 
                        array('site/login'), 
                        array('update'=>'#loginForm', 'success' => 'js:function(){window.location="'.$this->createUrl($model->originUrl).'"}',), 
                        array("class"=>"btn btn-primary btn-large")
                ); ?>
	</div>
<?php $this->endWidget(); ?>
    <div class="">
        <?php $this->widget('ext.hoauth.widgets.HOAuth'); ?>
    </div>
</div>