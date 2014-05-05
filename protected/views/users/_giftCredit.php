<div id='creditGiftForm'>
    <?php 
        $creditGiftForm = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'userCreditGift-form',
    //            'action'=>CController::createUrl('users/giftCredit'),
                'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
            )
        );
    ?>
        <div class="col-md-6">
            <div>
                <?php echo $creditGiftForm->errorSummary($model); ?>

                <?php if($this->opMessage){ ?>
                    <div id="alert-box" class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $this->opMessage;?></span>
                    </div>
                <?php } ?>

                <div><?php echo Yii::t('elot','Credito disponibile:'); ?></div>
                <?php echo CHtml::encode($model->available_balance_amount); ?>
            </div>
            <hr/>
            <div><?php echo Yii::t('elot','Regala credito!'); ?></div>
            <br/><br/>
            <?php 
            $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
            echo $creditGiftForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
            ?>
            <br/>
            <?php echo $creditGiftForm->textField($model, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
        </div>
        <div class="col-md-6">
            <?php echo $creditGiftForm->hiddenField($model, 'giftUserid', array('id'=>'gift-userid')); ?>
            <p>a: <span><?php echo $creditGiftForm->textField($model, 'giftUsername', array('id'=>'gift-username','readonly'=>'readonly')); ?></span></p>
            <div>
                <?php echo CHtml::button(Yii::t('wonlot','Persone che segui'), array('id'=>'1','class'=>'setFollow')); ?>
                <?php echo CHtml::button(Yii::t('wonlot','Persone che ti seguono'), array('id'=>'2','class'=>'setFollow')); ?>
            </div>
            <div class="following-box">
                <?php foreach($model->followings as $fl){ ?>
                <div class="user-small-box">
                    <input type="hidden" name="id" value="<?php echo $fl->user->id; ?>">
                    <input type="hidden" name="username" value="<?php echo $fl->user->username; ?>">
                    <span class="user-small-vendor-container">
                        <span class="small-username"><?php echo CHtml::encode($fl->user->username); ?></span>
                    </span>
                    <span class="user-small-avatar-container">                        
                        <?php echo CHtml::image("/images/userProfiles/".$fl->user->id."/smallThumb/".$fl->user->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                    </span>
                </div>
                <?php } ?>
            </div>
            <div class="follower-box">
                <?php foreach($model->followers as $fw){ ?>
                <div class="user-small-box">
                    <input type="hidden" name="id" value="<?php echo $fw->follower->id; ?>">
                    <input type="hidden" name="username" value="<?php echo $fw->follower->username; ?>">
                    <span class="user-small-vendor-container">
                        <a href="<?php echo CController::createUrl('users/view/'.$fw->follower->id);?>">
                            <span class="small-username"><?php echo CHtml::encode($fw->follower->username); ?></span>
                        </a>
                    </span>
                    <span class="user-small-avatar-container">
                        <a href="<?php echo CController::createUrl('users/view/'.$fw->follower->id);?>">
                            <?php echo CHtml::image("/images/userProfiles/".$fw->follower->id."/smallThumb/".$fw->follower->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                        </a>
                    </span>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php $this->endWidget(); ?>    
</div>