<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
        'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    

	<?php echo $form->errorSummary($model); ?>

        <?php if(Yii::app()->user->isAdmin()){ ?>
            <div class="form-group">
                    <?php echo $form->labelEx($model,'user_type_id'); ?>
                    <?php echo $form->dropDownList($model,'user_type_id',array_flip(Yii::app()->user->userTypes),array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'user_type_id'); ?>
            </div>
        <?php } ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

        <div class="form-group">
		<?php echo $form->labelEx($model,'is_guaranted_seller'); ?>
		<?php echo $form->checkBox($model,'is_guaranted_seller',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'is_guaranted_seller'); ?>
	</div>
        
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('wonlot','Crea') : Yii::t('wonlot','Salva') , array('class'=>'btn btn-success')); ?>
		<?php echo CHtml::link(Yii::t('wonlot','Dai promozione'), $this->createUrl('userSpecialOffers/create?userId='.$model->id), array('class'=>'btn btn-primary')); ?>
	</div>
        <div class="form-group">
            <?php 
                $dataProvider = new CActiveDataProvider('UserSpecialOffers');
                $dataProvider->setData($model->offers);
                $this->renderPartial('/userSpecialOffers/index', array('dataProvider'=>$dataProvider)); 
            ?>
        </div>
    

<?php $this->endWidget(); ?>

</div><!-- form -->