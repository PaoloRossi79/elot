<?php
$model = $this->paymentInfo;
$withdraw = $this->userWithdraw;
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'userPaymentInfo-form',
        'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
    )
);
?>

<div class="col-sm-12">
    <h4><?php echo Yii::t('wonlot','Inserisci i dati per la fatturazione'); ?></h4>
    <?php if($type == 'lottery'){ ?>
        <div><?php echo Yii::t('wonlot','Verrai contattato dal vincitore con questi dati identificativi:'); ?></div>
        <dl class="dl-horizontal">
            <dt>Email:</dt>
            <dd><?php echo CHtml::encode($winner->email); ?></dd>
        </dl>
        <?php echo Chtml::hiddenField('lot_id', $lottery->id); ?>
    <?php } elseif($type == "profile") { ?>
        <?php echo Chtml::hiddenField('for_profile', true); ?>
    <?php } elseif($type == "retriveCredit") { ?>
        <?php echo Chtml::hiddenField('for_credit', true); ?>
    <?php }  ?>
    <?php echo Chtml::hiddenField('return_url', $returnUrl); ?>
    <?php echo $form->hiddenField($model,'id'); ?>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'legal_name',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-10">
        <?php echo $form->textField($model, 'legal_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'address',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-10">
        <?php echo $form->textField($model, 'address', array('class' => 'form-control','size'=>45,'maxlength'=>255)); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'vat',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'vat', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>
    <div class="col-sm-2">
        <span><?php echo Yii::t('wonlot','oppure'); ?></span>
        <?php echo $form->labelEx($model,'fiscal_number',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'fiscal_number', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'iban',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'iban', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>
    <div class="col-sm-2">
        <span><?php echo Yii::t('wonlot','oppure'); ?></span>
        <?php echo $form->labelEx($model,'paypal_account',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'paypal_account', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
    </div>
</div>
<?php if($type == 'lottery'){ ?>
<div class="form-group">
    <div class="col-sm-12">
        <?php if(isset($lottery) && $lottery->paid_ref_id > 0){ ?>
            <?php if($lottery->paidInfo->is_completed){ ?>
                <h4><?php echo Yii::t('wonlot','Lotteria già pagata'); ?></h4>
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('wonlot','Pagamento eseguito da'); ?>:</dt>
                    <dd><?php echo CHtml::encode($lottery->paidInfo->completeUser->username); ?></dd>
                    <dt><?php echo Yii::t('wonlot','In data'); ?>:</dt>
                    <dd><?php echo CHtml::encode($lottery->paidInfo->complete_date); ?></dd>
                </dl>
            <?php } else { ?>
                <h4><?php echo Yii::t('wonlot','Lotteria già in attesa di pagamento'); ?></h4>
            <?php }  ?>
        <?php } else { ?>
            <?php echo CHtml::ajaxButton (Yii::t('wonlot','Richiedi pagamento'),
                Yii::app()->controller->createUrl('users/savePayInfo'), 
                array(
                  'type' => 'POST', 
                  'data'=>'js:$("#userPaymentInfo-form").serialize()',
                  'success'=>'js:function(data){
                      $.showResponse(data);
                  }',
                ),
                array('name'=>'reqPayBtn', 'class'=>'btn btn-primary buy-btn')
            ); ?>
        <?php } ?>
    </div>
</div>
<?php } else { ?>
<div class="form-group">
    <div class="col-sm-12">
        <?php echo CHtml::ajaxButton (Yii::t('wonlot','Salva i dati'),
            Yii::app()->controller->createUrl('users/savePayInfo'), 
            array(
              'type' => 'POST', 
              'data'=>'js:$("#userPaymentInfo-form").serialize()',
              'success'=>'js:function(data){
                  $.showResponse(data);
              }',
            ),
            array('name'=>'reqPayBtn', 'class'=>'btn btn-primary buy-btn')
        ); ?>
    </div>
</div>
<?php } ?>
<?php $this->endWidget(); ?>

<?php if(isset($lottery) && $lottery->paid_ref_id > 0){ ?>
    <script>
        $('#userPaymentInfo-form input').attr('disabled','disabled');
    </script>
<?php } ?>
<?php if($type == "retriveCredit") { ?>
    <hr>
    <?php
    $formDraw = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWithdraw-form',
            'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
        )
    );
    ?>
    <div class="form-group <?php echo ($model ? "" : "draw-block") ?>">
        <div class="col-sm-12">
            <?php 
            /*$opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
            echo $formDraw->radioButtonList($withdraw, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); */
            ?>
            <br/>
            <div><?php echo $formDraw->textField($withdraw, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45,'placeholder'=>Yii::t('wonlot','Importo da ritirare...'))); ?></div>
            <small><em>(<?php echo Yii::t('wonlot','Importo massimo:').' '.$this->userCredit; ?> WlMoney)</em></small>
            <div><?php echo CHtml::ajaxButton (Yii::t('wonlot','Ritira denaro'),
                Yii::app()->controller->createUrl('users/requestWithdraw'), 
                array(
                  'type' => 'POST', 
                  'data'=>'js:$("#userWithdraw-form").serialize()',
                  'success'=>'js:function(data){
                      $.showResponse(data);
                  }',
                ),
                array('name'=>'reqDrawBtn', 'class'=>'btn btn-primary buy-btn')
            );
            ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
<?php } ?>
<div class="form-group">
    <div class="col-sm-12">
        <div class="alert alert-danger error-block" style="display: none;">
            <div class="error-message"></div>
        </div>
        <div class="alert alert-success success-block" style="display: none;">
            <div class="success-message"></div>
        </div>
    </div>
</div>