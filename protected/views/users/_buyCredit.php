<div class="col-md-12" id="buyCreditTarget">
    <div class="col-md-6">
<?php 
    $creditForm = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWallet-form',
            'action'=>CController::createUrl('users/buyCredit'),
            'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
        )
    );
?>
    <?php echo $creditForm->errorSummary($model); ?>
        
        <div><?php echo Yii::t('elot','Credito disponibile:'); ?></div>
        <?php echo CHtml::encode($model->available_balance_amount); ?>
        <hr/>
        <br/><br/>
        <?php 
//        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        echo $creditForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
        ?>
        <br/>
        <?php //echo $creditForm->CMaskedTextField($model, 'creditOption', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        <?php echo $creditForm->textField($model, 'creditValue', array('class' => 'span3','size'=>10,'maxlength'=>10)); ?>
        <?php echo CHtml::submitButton(Yii::t('wonlot','Acquista credito'),array('class'=>'btn btn-success')); ?>
        <a class="btn btn-primary" id="retrive-credit-show"><?php echo Yii::t('wonlot','Ritira credito'); ?></a>
<?php $this->endWidget(); ?>    
        </div>
        <div class="col-md-6" id="retrive-credit-panel">
            <div class="text-block">
                <?php $this->widget(payLotteryInfoWidget,array('type'=>'retriveCredit')); ?>
            </div>
        </div>
        
</div>
