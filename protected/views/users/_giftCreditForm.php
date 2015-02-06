<div class="row">
    <?php 
        $userCredit = Yii::app()->user->walletValue;
        $remainingGiftCredit = Yii::app()->user->getRemainingGiftCredit();
        $availableGiftCredit = ($userCredit < $remainingGiftCredit) ? $userCredit : $remainingGiftCredit;
        $creditGiftForm = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'userCreditGift-form',
    //            'action'=>CController::createUrl('users/giftCredit'),
                'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
            )
        );
    ?>
    <?php if($remainingGiftCredit <= 0){ ?>
        <div class="col-md-12">
            <blockquote>
                <p><strong><?php echo Yii::t("wonlot","ATTENZIONE"); ?></strong></p>
                <small>
                    <p><?php echo Yii::t("wonlot","E\' già stata raggiunta la soglia massima mensile di credito regalabile (€ 250)"); ?></p>
                    <p><strong><?php echo Yii::t("wonlot","Non è possibile"); ?></strong> <?php echo Yii::t("wonlot","regalare altro credito."); ?></p>
                </small>
            </blockquote>
        </div>
    <?php } else { ?>
            <?php if($this->opMessage){ ?>
                <script>
                    setTimeout(function(){ location.reload(); }, 3000);
                </script>
                <div id="alert-box" class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $this->opMessage;?></span>
                </div>
            <?php } ?>
            <div class="col-md-6">
                <blockquote>
                    <p><strong><?php echo Yii::t("wonlot","INFO"); ?></strong></p>
                    <small>
                        <p><?php echo Yii::t("wonlot","Qui è possibile regalare del credito ad altri utenti Wonlot. Il valore massimo del credito regalabile è di € 250 (mensili)"); ?></p>
                        <p><strong><?php echo Yii::t("wonlot","Attenzione:"); ?></strong> <?php echo Yii::t("wonlot","il credito regalato non è rimborsabile."); ?></p>
                    </small>
                </blockquote>
                <div>
                    <?php echo $creditGiftForm->errorSummary($model); ?>
                </div>
                <?php 
                $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
                echo $creditGiftForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
                ?>
                <br/>
                <div><?php echo $creditGiftForm->textField($model, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45,'placeholder'=>Yii::t('wonlot','Importo da regalare...'))); ?> €</div>
                <small><em>(<?php echo Yii::t('wonlot','Importo massimo:').' '.$availableGiftCredit.' '.Yii::t('wonlot','WlMoney'); ?>)</em></small>
            </div>
            <div class="col-md-6">
                <h4><?php echo Yii::t("wonlot","Destinatario:"); ?> <h5><?php echo $creditGiftForm->textField($model, 'giftUsername', array('id'=>'gift-username','readonly'=>'readonly')); ?></h5></h4>
                <?php echo $creditGiftForm->hiddenField($model, 'giftUserid', array('id'=>'gift-userid')); ?>
                <div>
                    <span><?php echo Yii::t("wonlot","A:"); ?></span>
                    <?php echo CHtml::button(Yii::t('wonlot','Persone che segui'), array('id'=>'1','class'=>'btn btn-primary setFollow')); ?>
                    <?php echo CHtml::button(Yii::t('wonlot','Persone che ti seguono'), array('id'=>'2','class'=>'btn btn-primary setFollow')); ?>
                </div>
                <div class="following-box">
                    <?php foreach($model->followings as $fl){ ?>
                    <div class="user-small-box">
                        <input type="hidden" name="id" value="<?php echo $fl->user->id; ?>">
                        <input type="hidden" name="username" value="<?php echo $fl->user->username; ?>">
                        <div class="user-small-vendor-container">
                            <span class="small-username"><?php echo CHtml::encode($fl->user->username); ?></span>
                        </div>
                        <div class="user-small-avatar-container">                        
                            <?php // echo CHtml::image("/images/userProfiles/".$fl->user->id."/smallThumb/".$fl->user->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                            <?php echo Users::model()->getImageTag($fl->user); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="follower-box">
                    <?php foreach($model->followers as $fw){ ?>
                    <div class="user-small-box">
                        <input type="hidden" name="id" value="<?php echo $fw->follower->id; ?>">
                        <input type="hidden" name="username" value="<?php echo $fw->follower->username; ?>">
                        <div class="user-small-vendor-container">
                                <span class="small-username"><?php echo CHtml::encode($fw->follower->username); ?></span>
                        </div>
                        <div class="user-small-avatar-container">
                                <?php // echo CHtml::image("/images/userProfiles/".$fw->follower->id."/smallThumb/".$fw->follower->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                                <?php echo Users::model()->getImageTag($fw->follower); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php $this->endWidget(); ?>    
</div>