<div class="" id="buyCreditTarget">
<?php 
    $creditForm = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWallet-form',
            'action'=>CController::createUrl('users/buyCredit'),
            'htmlOptions' => array('class' => 'well','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
?>
    <?php echo $creditForm->errorSummary($model); ?>
        
        <div><?php echo Yii::t('elot','Credito disponibile:'); ?></div>
        <?php echo CHtml::encode($model->available_balance_amount); ?>
        <hr/>
        <div><?php echo Yii::t('elot','Acquista credito!'); ?></div>
        <br/><br/>
        <?php 
//        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        echo $creditForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
        ?>
        <br/>
        <?php //echo $creditForm->CMaskedTextField($model, 'creditOption', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        <?php echo $creditForm->textField($model, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        <?php echo CHtml::submitButton("Acquista credito",array('class'=>'btn btn-success')); ?>
<?php $this->endWidget(); ?>    
</div>
