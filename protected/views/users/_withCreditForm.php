<hr>
    <?php
    $withdraw = $this->userWithdraw;
    $userCredit = Yii::app()->user->walletValue;
    $formDraw = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userWithdrawReq-form',
//            'action'=>$controller->createUrl('users/requestWithdraw'),
            'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
        )
    );
    ?>

    <?php if($resOk){ ?>
        <div id="alert-box" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $resOk;?></span>
        </div>
    <?php } ?>
    <?php if($resError){ ?>
        <div id="alert-box" class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $resError;?></span>
        </div>
    <?php } ?>
    <div class="form-group">
        <div class="col-md-12">
            <div>
                <?php echo $formDraw->textField($withdraw, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45,'placeholder'=>Yii::t('wonlot','Importo da ritirare...'))); ?> €
                <small id="valueWithCommissionBlock"> <em>(<?php echo Yii::t('wonlot','con commissione Wonlot:'); ?>  <strong><span id="valueWithCommission" class=""></span></strong>  <?php echo Yii::t('wonlot','WlMoney'); ?>)</em></small>
            </div>
            <small><em>(<?php echo Yii::t('wonlot','Importo massimo:').' '.($userCredit - ($userCredit / 100)).' '.Yii::t('wonlot','€'); ?>)</em></small>
            <br/>
            <small><em><?php echo Yii::t('wonlot','Come da condizioni generali, la commissione Wonlot sul prelievo è dell\'  ') . "<strong>1 %</strong>"; ?></em></small>
            
        </div>
    </div>
    
    <?php $this->endWidget(); ?>