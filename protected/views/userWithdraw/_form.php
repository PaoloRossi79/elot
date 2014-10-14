<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */
/* @var $form CActiveForm */
?>

<?php 
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWithdraw-form',
            'htmlOptions' => array('class' => 'well form-horizontal','enctype' => 'multipart/form-data', 'role' => 'form'), // for inset effect
        )
    );
?>
<fieldset>
 
    <legend><?php echo Yii::t('wonlot','Richiesta di prelievo di: ').$model->user->username;?></legend>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'user_id'); ?>

<!--        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
        </div>-->
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'value',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'value',array('disabled'=>'disabled','class'=>'form-control')); ?>
		<?php echo $form->error($model,'value'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'created',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'created',array('disabled'=>'disabled','class'=>'form-control')); ?>
		<?php echo $form->error($model,'created'); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php 
                    if($model->status < 2){
                        $dropStatusDisable = array('class'=>' form-control');
                    } else {
                        $dropStatusDisable = array('class'=>' form-control','disabled'=>'disabled');
                    }
                    echo $form->dropDownList(
                        $model,
                        'status',
                        Yii::app()->params['payStatusConst'],
                        $dropStatusDisable
                    );
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'paid_ref',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
		<?php echo $form->textField($model,'paid_ref',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'paid_ref'); ?>
            </div>
        </div>
        
	<div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('wonlot','Paga'), array('name' => 'search', 'class' => 'btn btn-success')); ?>
        </div>
</fieldset>

<?php $this->endWidget(); ?>