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
    }
?>
<tr class="notify-row <?php echo $isReadClass; ?>" name="<?php echo $data->id; ?>">
    <?php if($type == "ticket"){?>
        <td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "Ticket", array("class"=>"img-responsive")); ?>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php if($no->fromUser){ ?>
                    <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    <span><?php echo CHtml::encode($data->fromUser->getUsername()); ?></span>
                <?php } ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php //echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('tickets/view/'.$data->message_value)); ?>
                <?php echo Tickets::model()->getLotBoxTag($data->message_value); ?>
            <?php } else {  ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php //echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('tickets/view/'.$data->message_value)); ?>
                <?php echo Tickets::model()->getLotBoxTag($data->message_value); ?>
                <span> a: </span>
                <?php if($no->toUser){ ?>
                    <?php echo Users::model()->getImageTag($data->toUser); ?>
                    <span><?php echo CHtml::encode($data->toUser->getUsername()); ?></span>
                <?php } ?>
            <?php } ?>
        </td>
    <?php } elseif($type == "money"){ ?>
        <td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/wl-money.png", "WlMoney", array("class"=>"img-responsive")); ?>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php if($no->fromUser){ ?>
                    <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    <span><?php echo CHtml::encode($data->fromUser->getUsername()); ?></span>
                <?php } ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            <?php } else {  ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php //echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                <span> a: </span>
                <?php if($no->toUser){ ?>
                    <?php echo Users::model()->getImageTag($data->toUser); ?>
                    <span><?php echo CHtml::encode($data->toUser->getUsername()); ?></span>
                <?php } ?>
            <?php } ?>

        </td>
    <?php } else { ?>
        <?php if($data->from_user_id == Yii::app()->user->id){ ?>
            <td>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            </td>
            <td>
                <?php if($no->toUser){ ?>
                    <?php echo Users::model()->getImageTag($data->toUser); ?>
                    <span><?php echo CHtml::encode($data->toUser->getUsername()); ?></span>
                <?php } ?>
            </td>
        <?php } else {  ?>
            <td>
                <?php if($no->fromUser){ ?>
                    <?php echo Users::model()->getImageTag($data->fromUser); ?>
                    <span><?php echo CHtml::encode($data->fromUser->getUsername()); ?></span>
                <?php } ?>
            </td>
            <td>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            </td>
        <?php } ?>
    <?php }  ?>
</tr>