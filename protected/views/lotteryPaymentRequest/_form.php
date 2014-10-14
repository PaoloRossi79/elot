<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */
/* @var $form CActiveForm */
?>

<?php 
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'lottery-payment-request-form',
            'htmlOptions' => array('class' => 'well form-horizontal','enctype' => 'multipart/form-data', 'role' => 'form'), // for inset effect
        )
    );
?>
<fieldset>
 
    <legend>
        <?php echo Yii::t('wonlot','Richiesta di pagamento di: ').$model->user->username;?>
        <br>
        <?php echo Yii::t('wonlot','Asta: ').$model->lottery->name;?>
    </legend>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'from_user_id'); ?>

<!--        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>-->
        
        <div class="form-group">
            <?php echo $form->labelEx($model->lottery,'ticket_sold_value',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model->lottery,'ticket_sold_value',array('disabled'=>'disabled','class'=>'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'sent_date',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'sent_date',array('disabled'=>'disabled','class'=>'form-control')); ?>
		<?php echo $form->error($model,'sent_date'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'is_completed',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php 
                    if($model->is_completed){
                        $dropStatusDisable = array('class'=>' form-control','disabled'=>'disabled');
                    } else {
                        $dropStatusDisable = array('class'=>' form-control');
                    }
                    echo $form->checkBox(
                        $model,
                        'is_completed',
                        $dropStatusDisable
                    );
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'complete_ref',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'complete_ref',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'complete_ref'); ?>
            </div>
        </div>
        
	<div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('wonlot','Paga'), array('name' => 'search', 'class' => 'btn btn-success')); ?>
        </div>
</fieldset>

<?php $this->endWidget(); ?>

<?php $this->widget('viewLotteryWidget',array('model'=>$model->lottery)); ?>  