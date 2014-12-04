<?php
    $isReadClass = ($no->to_user_id == Yii::app()->user->id && !$no->message_read) ? "notify-unread" : "notify-read";
    $no = $data;
    $notifyTypeConst = Yii::app()->params['notifyTypeConst'];
    if(in_array($data->message_type,
        array($notifyTypeConst['giftTicket'],
            $notifyTypeConst['winLottery'],
            $notifyTypeConst['extractLottery'],
            $notifyTypeConst['refoundTicket']
            ))){
        $type = "ticket";
    } elseif(in_array($data->message_type,
            array($notifyTypeConst['giftCredit'],
                  $notifyTypeConst['widthdrawSent'],
                  $notifyTypeConst['widthdrawComplete']))){
        
        $type = "money";
    } elseif(in_array($data->message_type,
            array($notifyTypeConst['startFollow'],
                  $notifyTypeConst['stopFollow'],
                  $notifyTypeConst['widthdrawComplete']))){
        
        $type = "follow";
    }
?>
<tr class="notify-row <?php echo $isReadClass; ?>" name="<?php echo $data->id; ?>">
    <?php if($type == "ticket"){?>
        <td class="first-notify-col">
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "Ticket", array("class"=>"img-responsive first-notify-col-img")); ?>
        </td>
        <td>
            <?php $lotBox = Tickets::model()->getLotBoxTags($data->message_value); ?>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php if($no->fromUser){ ?>
                    <div class="pull-left">
                        <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    </div>
                <?php } else { ?>
                    <div class="pull-left img-avatar"></div>
                <?php }  ?>
                <div class="pull-left notify-desc">
                    <?php if($no->fromUser){ ?>
                      <div><b><?php echo CHtml::encode($data->fromUser->getUsername()); ?></b></div>
                    <?php } ?>
                    <div><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></div>
                    <div><b><?php echo CHtml::encode($lotBox["name"]); ?></b></div>
                </div>
                <div class="pull-left">
                    <?php echo $lotBox["url"] ?>
                </div>
            <?php } else {  ?>
                <div class="pull-left">
                    <?php echo $lotBox["url"] ?>
                </div>
                <div class="pull-left notify-desc">
                    <div><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></div>
                    <div><b><?php echo CHtml::encode($lotBox["name"]); ?></b></div>
                    <?php if($no->toUser){ ?>
                        <div>a: <b><?php echo CHtml::encode($data->toUser->getUsername()); ?></b></div>
                    <?php } ?>    
                </div>
                <div class="pull-left">
                    <?php if($no->toUser){ ?>
                        <?php echo Users::model()->getImageTag($data->toUser); ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </td>
    <?php } elseif($type == "money"){ ?>
        <td class="first-notify-col">
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/wl-money.png", "WlMoney", array("class"=>"img-responsive first-notify-col-img")); ?>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php if($no->fromUser){ ?>
                    <div class="pull-left">
                        <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    </div>
                <?php } else { ?>
                    <div class="pull-left img-avatar"></div>
                <?php }  ?>
                <div class="pull-left notify-desc">
                    <?php if($no->fromUser){ ?>
                      <div><b><?php echo CHtml::encode($data->fromUser->getUsername()); ?></b></div>
                    <?php } ?>
                    <div>
                        <?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?>
                        <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile#tabProfile2')); ?>
                    </div>
                </div>
            <?php } else {  ?>
                <div class="pull-left">
                    <?php if($no->toUser){ ?>
                        <?php echo Users::model()->getImageTag($data->toUser); ?>
                    <?php } ?>
                </div>
                <div class="pull-left notify-desc">
                    <div>
                        <?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?>
                        <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile#tabProfile2')); ?>
                    </div>
                    <?php if($no->toUser){ ?>
                        <div>a: <b><?php echo CHtml::encode($data->toUser->getUsername()); ?></b></div>
                    <?php } ?>    
                </div>    
            <?php } ?>

        </td>
    <?php } elseif($type == "follow"){ ?>
        <td class="first-notify-col">
            <div class="first-notify-col-img"><span class="btn btn-default btn-lg" disabled="disabled"><i class="glyphicon glyphicon-eye-open"></i></span></div>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php if($no->fromUser){ ?>
                    <div class="pull-left">
                        <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    </div>
                <?php } else { ?>
                    <div class="pull-left img-avatar"></div>
                <?php }  ?>
                <div class="pull-left notify-desc">
                    <?php if($no->fromUser){ ?>
                      <div><b><?php echo CHtml::encode($data->fromUser->getUsername()); ?></b></div>
                    <?php } ?>
                    <div><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></div>
                </div>
            <?php } else {  ?>
                <?php if($no->toUser){ ?>
                    <div class="pull-left">
                        <?php echo Users::model()->getImageTag($data->toUser); ?>
                    </div>
                <?php } else { ?>
                    <div class="pull-left img-avatar"></div>
                <?php }  ?>
                <div class="pull-left notify-desc">
                    <div><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></div>
                    <?php if($no->toUser){ ?>
                      <div><b><?php echo CHtml::encode($data->fromUser->getUsername()); ?></b></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </td>
    <?php } else { //NON USATA, per ora!!! ?>
        
    <?php }  ?>
</tr>