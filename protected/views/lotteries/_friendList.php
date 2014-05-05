<?php $user = Users::model()->findByPk(Yii::app()->user->id); ?>

<div class="friends">
    <div class="friends-list">
            <?php if($list) { ?>
                <div class="social-friend-block">
                    <script>
                        $('.box-spinner').hide();
                    </script>
                    <table>
                        <?php foreach ($list as $f) { ?>
                            <tr>
                                <td><img style="width: 50px; height: 50px;" src="<?php echo $f->photoURL; ?>"></td>
                                <td><?php echo $f->displayName; ?></td>
                                <td>
                                    <button class="btn btn-primary feedShare" id='<?php echo $f->identifier; ?>' data-provider="<?php echo $provider; ?>">
                                        <?php echo Yii::t('wonlot','Regala'); ?>
                                    </button>
                                    <?php 
                                    $msg = urlencode("Ti ho regalato un biglietto su Wonlot.com!");
                                    $baseUrl = Yii::app()->getBaseUrl(true);
                                    $url = "https://www.facebook.com/dialog/feed?app_id=$appId&display=popup&caption=$msg&link=$baseUrl&redirect_uri=$baseUrl/lotteries/gift";
                                    ?>
                                    <!--<a class="feedShare">Regala!</a>-->
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php }  ?>
            <div class="gift-ticket-box" name='1'>
                <?php $formEmail=$this->beginWidget('CActiveForm',array('id'=>'gift-email-form'),array('role' => 'form')); ?>
                
                    <div id="emailFormGroup" class="form-group">
                      <?php echo CHtml::emailField("giftEmail",'',array('id'=>'giftEmail','placeholder' => "Email", 'class' => 'form-control')); ?>                
                        <p id="giftErrorText" class="text-danger"><?php echo Yii::t('wonlot','Email non valida'); ?></p>
                        <p id="giftSuccessText" class="text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>
                    </div>
                    <?php echo CHtml::ajaxButton ("Regala!",
                        CController::createUrl('lotteries/gift'), 
                        array(
                          'update' => '#data-'.$data->id,
                          'type' => 'POST', 
                          'data'=>array('user'=>'js:$("#gift-email-form").serialize()','ticketId'=>'js:$("#ticketIdForGift").val()'),
//                          'data'=>'js:$("#gift-email-form").serialize()',
                          'beforeSend'=>'function(){
                               if($("#giftEmail").val()){
                                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                    if(!regex.test($("#giftEmail").val())){
                                        $("#emailFormGroup").addClass("has-error");
                                        $("#emailErrorText").show();
                                        return false;
                                    } 
                               } else {
                                        $("#emailFormGroup").addClass("has-error");
                                        $("#emailErrorText").show();
                                        return false;
                               }
                           }',
                           'success'=>'function(data){
                                $.updateTicketGift(data);
                            }',
                        ),
                        array('name'=>'giftBtn', 'id'=>'gift-btn-1', 'class'=>'btn btn-primary buy-btn')
                        ); ?>
                <?php $this->endWidget(); ?>
            </div>
        <div class="gift-ticket-box" name='2'>
            <?php $formFollow=$this->beginWidget('CActiveForm',array('id'=>'gift-ticket-following-form'),array('role' => 'form')); ?>
                <div id="followingFormGroup" class="form-group">
                  <p id="giftErrorText" class="text-danger"><?php echo Yii::t('wonlot','Errore di invio regalo'); ?></p>
                  <p id="giftSuccessText" class="text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>        
                  <?php echo CHtml::hiddenField('gift-userid',null, array()); ?>
                  <p>Regala il biglietto a: <span><?php echo CHtml::textField('gift-username',null, array('readonly'=>'readonly')); ?></span></p>
                </div>
                <?php if(count($user->followings) > 0){ ?>
                    <div class="">
                        <h4>Persone che segui</h4>
                        <?php foreach($user->followings as $fl){ ?>
                        <div class="user-small-ticket-box">
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
                    <?php 
                        echo CHtml::ajaxButton ("Regala",
                                CController::createUrl('lotteries/gift'), 
                                array('update' => '#data-'.$data->id,
                                        'type' => 'POST', 
                                        'data'=>array('user'=>'js:$("#gift-ticket-following-form").serialize()','ticketId'=>'js:$("#ticketIdForGift").val()'),
                                        'success'=>'function(data){
                                            $.updateTicketGift(data);
                                        }',
                                ),array('name'=>'giftBtn', 'id'=>'gift-btn-2', 'class'=>'btn btn-primary buy-btn'));
                    ?>
                <?php } ?>
            <?php $this->endWidget(); ?>
        </div>
        <div class="gift-ticket-box" name='3'>
            <?php $formFollower=$this->beginWidget('CActiveForm',array('id'=>'gift-ticket-follower-form'),array('role' => 'form')); ?>
                <div id="followingFormGroup" class="form-group">
                  <p id="giftErrorText" class="text-danger"><?php echo Yii::t('wonlot','Errore di invio regalo'); ?></p>
                  <p id="giftSuccessText" class="text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>
                  <?php echo CHtml::hiddenField('gift-userid',null, array()); ?>
                  <p>Regala il biglietto a: <span><?php echo CHtml::textField('gift-username',null, array('readonly'=>'readonly')); ?></span></p>
                </div>
                <?php if(count($user->followers) > 0){ ?>
                    <div class="">
                        <h4>Persone che ti seguono</h4>
                        <?php foreach($user->followers as $fw){ ?>
                        <div class="user-small-ticket-box">
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
                    <?php 
                        echo CHtml::ajaxButton ("Regala",
                                CController::createUrl('lotteries/gift'), 
                                array('update' => '#data-'.$data->id,
                                        'type' => 'POST', 
                                        'data'=>array('user'=>'js:$("#gift-ticket-follower-form").serialize()','ticketId'=>'js:$("#ticketIdForGift").val()'),
                                        'success'=>'function(data){
                                            $.updateTicketGift(data);
                                        }',
                                ),array('name'=>'giftBtn', 'id'=>'gift-btn-3', 'class'=>'btn btn-primary buy-btn'));
                    ?>
                <?php } ?>
            <?php $this->endWidget(); ?>
            
        </div>
    </div>				
    <div class="clear"></div>
</div>