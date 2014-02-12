<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        <?php if($authenticated) { ?>
            <script type="text/javascript">
                window.top.location = "<?php echo Yii::app()->getBaseUrl(true).$this->createUrl($model->originUrl); ?>";
            </script>
        <?php } ?>
        <?php
        $model = isset($model) ? $model : new LoginForm;
        if($this->getAction()->getId() !== "error"){
            $model->originUrl = $this->getId() . '/' . $this->getAction()->getId();
        }
        ?>
        <div class="form">
        <?php $form=$this->beginWidget('CActiveForm'); ?>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
		<?php echo $form->textField($model,'username',array('placeholder' => 'email')); ?>
		<?php echo $form->error($model,'username'); ?>
		<?php echo $form->passwordField($model,'password',array('placeholder' => 'password')); ?>
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
                            /*array('update'=>'#loginForm', 'success' => 'js:function(data){'
                                . 'alert(data);'
                                . 'if(data.authenticated){'
                                . '     window.location="'.$this->createUrl($model->originUrl).'"'
                                . '}}'
                                ), */
                            array('update'=>'#loginForm'),
                            array("class"=>"btn btn-primary btn-large")
                    );
    //                echo CHtml::Button(Yii::t('app', 'Submit') ,array('onclick'=>'send();'));
                    ?>
            </div>

        <?php $this->endWidget(); ?>
        </div><!-- form -->
        <div class="">
            <?php $this->widget('ext.hoauth.widgets.HOAuth'); ?>
        </div>
      </div>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>