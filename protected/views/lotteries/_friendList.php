<?php $user = Users::model()->findByPk(Yii::app()->user->id); ?>

<div class="friends">
    <div class="friends-list">
            
            <div class="gift-ticket-box" name='0'>
              <?php $this->renderPartial('/lotteries/_socialFriendList'); ?>
            </div>
            <div class="gift-ticket-box" name='1'>
                <div id="emailFormGroup" class="form-group">
                  <?php echo $form->emailField($formModel,'giftToEmail',array('placeholder' => "Email", 'class' => 'form-control')); ?>                
                    <p class="giftErrorText text-danger"><?php echo Yii::t('wonlot','Email non valida'); ?></p>
                    <p class="giftSuccessText text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>
                </div>
            </div>
        <div class="gift-ticket-box" name='2'>
            <?php if(count($user->followings) > 0){ ?>
                <div class="">
                    <?php foreach($user->followings as $fl){ ?>
                    <div class="user-small-ticket-box">
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
            <?php } ?>
        </div>
        <div class="gift-ticket-box" name='3'>
            <?php if(count($user->followers) > 0){ ?>
                <div class="">
                    <?php foreach($user->followers as $fw){ ?>
                        <?php if($fw->follower){ ?>
                            <div class="user-small-ticket-box">
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
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>				
    <div class="clear"></div>
</div>