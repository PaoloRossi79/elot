<?php 
    $creditForm = $this->beginWidget(
        'bootstrap.widgets.CActiveForm',
        array(
            'id' => 'userWallet-form',
            'action'=>CController::createUrl('users/buyCredit'),
            'htmlOptions' => array('class' => 'well','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
?>
    <?php echo $creditForm->errorSummary($model); ?>
    
    <div class="">
        <div><?php echo Yii::t('elot','WALLET AVAILABLE AMOUNT:'); ?></div>
        <?php echo CHtml::encode($model->available_balance_amount); ?>
        <hr/>
        <div><?php echo Yii::t('elot','Buy more credit!'); ?></div>
        <br/><br/>
        <?php 
//        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
        echo $creditForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
        ?>
        <br/>
        <?php //echo $creditForm->CMaskedTextField($model, 'creditOption', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        <?php echo $creditForm->textField($model, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        <div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('elot','BuyCredit')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>