<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Register';
?>

<div class="col-md-offset-1 col-md-10">
    <div class="panel panel-default bootstrap-widget-table">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo Yii::t('wonlot','Registrati');?></h3>
        </div>
        <div class="panel-body">
            <div class="form">
            <?php $form=$this->beginWidget('CActiveForm',array(
                    'id'=>'user_register_form',
                    'htmlOptions' => array('enctype' => 'multipart/form-data', 'role' => 'form'), // for inset effect
                )); ?>

                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <div class="row">
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'email',array('class'=>' control-label')); ?>
                            <?php echo $form->textField($model,'email',array('class'=>' form-control')); ?>
                            <?php echo $form->error($model,'email'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'confirm email',array('class'=>' control-label')); ?>
                            <?php echo $form->textField($model,'confirmEmail',array('class'=>' form-control')); ?>
                            <?php echo $form->error($model,'confirmEmail'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'password',array('class'=>' control-label')); ?>
                            <?php echo $form->passwordField($model,'password',array('class'=>' form-control')); ?>
                            <?php echo $form->error($model,'password'); ?>
            <!--		<p class="hint">
                                    Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                            </p>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'confirm password',array('class'=>' control-label')); ?>
                            <?php echo $form->passwordField($model,'confirmPassword',array('class'=>' form-control')); ?>
                            <?php echo $form->error($model,'confirmPassword'); ?>
            <!--		<p class="hint">
                                    Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                            </p>-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <?php echo $form->labelEx($model,'username',array('class'=>' control-label')); ?>
                            <?php echo $form->textField($model,'username',array('class'=>' form-control')); ?>
                            <?php echo $form->error($model,'username'); ?>
                            <span id="checkUsername" style="display: none;">
                                <span id="checkUsernameOk" style="display: none;" class="label label-success"><span class="glyphicon glyphicon-ok"></span>Libero!</span>
                                <span id="checkUsernameKo" style="display: none;" class="label label-danger"><span class="glyphicon glyphicon-remove"></span>Occupato!</span>
                            </span>
                            <?php 
                                /*echo CHtml::ajaxButton ("Verifica",
                                    CController::createUrl('users/ajaxCheckUsername'), 
                                    array('update' => '#checkUsername',
                                          'type' => 'POST', 
                                          'data'=>'js:$("#user_register_form").serialize()',
                                          'success' => "js:function(data, status)
                                            {
                                            alert(data);
                                               if(data){
                                                    $('#checkUsernameOk').show();
                                                    $('#checkUsernameKo').hide();
                                               } else {
                                                    $('#checkUsernameKO').show();
                                                    $('#checkUsernameOk').hide();
                                               }
                                               $('#checkUsername').fadeIn();
                                            }",
                                    ),
                                    array("class"=>"btn btn-primary btn-large")
                                );*/
                            ?>
                        </div>
                    </div>

                    <div class="row rememberMe checkbox-container">
                        <div class="checkbox">
                            <?php echo $form->checkBox($model,'terms'); ?>
                            <?php echo $form->label($model,'Accetti i termini e condizioni?',array('class'=>' ')); ?>
                            <?php echo $form->error($model,'terms'); ?>
                        </div>
                    </div>
                    <div class="row rememberMe checkbox-container">
                        <div class="checkbox">
                            <?php echo $form->checkBox($model,'persdatamng',array('class'=>' ')); ?>
                            <?php echo $form->label($model,'Accetti il termini di gestione dei dati personali?',array('class'=>'')); ?>
                            <?php echo $form->error($model,'persdatamng'); ?>
                        </div>
                    </div>
                    <div class="row rememberMe checkbox-container">
                        <div class="checkbox">
                            <?php echo $form->checkBox($model,'newsletterAccept',array('class'=>' ')); ?>
                            <?php echo $form->label($model,'Accetti di ricevere newsletter promozionali sulle aste in corso?',array('class'=>'')); ?>
                            <?php echo $form->error($model,'newsletterAccept'); ?>
                        </div>
                    </div>

                    <div class="row buttons">
                        <div class="form-group">
                            <?php echo CHtml::submitButton('Register',array("class"=>"btn btn-primary btn-large")); ?>
                            <div class="text-danger"><?php echo Yii::t("wonlot"," ATTENZIONE! Per attivare l’account dovete confermare l’iscrizione cliccando su CONFERMA ISCRIZIONE nella mail che riceverete."); ?></div>
                        </div>
                    </div>

            <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
    </div>
</div>