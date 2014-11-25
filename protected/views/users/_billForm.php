<?php
if(!$paymentInfo){
    $paymentInfo = Yii::app()->user->payInfo;
}
$userCredit = Yii::app()->user->walletValue;
$userInfoModel = UserPaymentInfo::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
if(!$paymentInfo){
    $paymentInfo = new UserPaymentInfo;
} else {
    if(($userInfoModel->vat || $userInfoModel->fiscal_number) && ($userInfoModel->iban || $userInfoModel->paypal_account)){
        $isComplete = true;
    }
}
$model = $paymentInfo;
$withdraw = new UserWithdraw;

$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'userPaymentInfoReq-form',
        'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
    )
);
?>

<?php if($resOk){ ?>
        <div id="alert-box" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $resOk;?></span>
            <?php if($redirect){ ?>
                <script>
                    window.location.href = "<?php echo $redirect; ?>";
                </script>
                <a href="<?php echo $redirect; ?>" class="btn btn-primary">Crea asta</a>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if($resError){ ?>
        <div id="alert-box" class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $resError;?></span>
        </div>
    <?php } ?>

<div class="col-sm-12">
    <h4><?php echo Yii::t('wonlot','Inserisci i dati per la fatturazione'); ?></h4>
    <?php echo Chtml::hiddenField('for_credit', true); ?>
    <?php echo Chtml::hiddenField('return_url', $redirect); ?>
    <?php echo $form->hiddenField($model,'id'); ?>
</div>
<!--<div class="form-group">
    <div class="col-sm-2">
        
    </div>
    <div class="col-sm-10">
        
    </div>
</div>-->
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'legal_name',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-10">
        <?php echo $form->textField($model, 'legal_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'legal_name'); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'address',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-10">
        <?php echo $form->textField($model, 'address', array('class' => 'form-control','size'=>45,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'vat',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'vat', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'vat'); ?>
    </div>
    <div class="col-sm-2">
        <span><?php echo Yii::t('wonlot','oppure'); ?></span>
        <?php echo $form->labelEx($model,'fiscal_number',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'fiscal_number', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'fiscal_number'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2">
        <?php echo $form->labelEx($model,'iban',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'iban', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'iban'); ?>
    </div>
    <div class="col-sm-2">
        <span><?php echo Yii::t('wonlot','oppure'); ?></span>
        <?php echo $form->labelEx($model,'paypal_account',array('class'=>'control-label'));?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'paypal_account', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
        <?php echo $form->error($model,'paypal_account'); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
