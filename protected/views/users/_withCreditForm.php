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
        <div class="col-sm-12">
            <?php 
            /*$opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
            echo $formDraw->radioButtonList($withdraw, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); */
            ?>
            <br/>
            <div><?php echo $formDraw->textField($withdraw, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45,'placeholder'=>Yii::t('wonlot','Importo da ritirare...'))); ?> €</div>
            <small><em>(<?php echo Yii::t('wonlot','Importo massimo:').' '.$userCredit.' '.Yii::t('wonlot','WlMoney'); ?>)</em></small>
        </div>
    </div>
    
    <?php $this->endWidget(); ?>