<div class="" id="buyCreditTarget">
<?php 
    $creditForm = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWallet-form',
//            'action'=>CController::createUrl('users/buyCredit'),
            'htmlOptions' => array('class' => 'well','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
?>
    <?php echo $creditForm->errorSummary($model); ?>
        
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
		<?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'buttonType' => 'ajaxLink',
                'label' => 'Buy Credit',
                'url' => CController::createUrl('users/buyCredit'), 
                'ajaxOptions' => array(
                    'update' => '#buyCreditTarget',
                    'type' => 'POST', 
                    'data'=>'js:jQuery(this).parents("form").serialize()',
                ),
            )
        ); ?>
        <?php echo CHtml::ajaxButton ("Buy Credit",
            CController::createUrl('users/buyCredit'), 
            array('update' => '#buyCreditTarget',
                    'type' => 'POST', 
                    'data'=>'js:jQuery(this).parents("form").serialize()',
            )); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
