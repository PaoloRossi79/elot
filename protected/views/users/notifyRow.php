<?php
    $isReadClass = ($no->to_user_id == Yii::app()->user->id && !$no->message_read) ? "notify-unread" : "notify-read";
    $no = $data;
?>
<tr class="notify-row <?php echo $isReadClass; ?>" name="<?php echo $data->id; ?>">
    <?php if(in_array($data->message_type,$data->related['ticket'])){?>
        <td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "Ticket", array("class"=>"img-responsive")); ?>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php echo CHtml::image("/images/userProfiles/".$data->from_user_id."/smallThumb/".$data->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('tickets/view/'.$data->message_value)); ?>
            <?php } else {  ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('tickets/view/'.$data->message_value)); ?>
                <span> a: </span>
                <?php echo CHtml::image("/images/userProfiles/".$data->to_user_id."/smallThumb/".$data->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                <span><?php echo CHtml::encode($data->toUser->username); ?></span>
            <?php }   ?>
        </td>
    <?php } elseif(in_array($data->message_type,$data->related['money'])){ ?>
        <td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/wl-money.png", "WlMoney", array("class"=>"img-responsive")); ?>
        </td>
        <td>
            <?php if($data->to_user_id == Yii::app()->user->id){ ?>
                <?php echo CHtml::image("/images/userProfiles/".$data->from_user_id."/smallThumb/".$data->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            <?php } else {  ?>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                <span> a: </span>
                <?php echo CHtml::image("/images/userProfiles/".$data->to_user_id."/smallThumb/".$data->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                <span><?php echo CHtml::encode($data->toUser->username); ?></span>
            <?php }  ?>

        </td>
    <?php } else { ?>
        <?php if($data->from_user_id == Yii::app()->user->id){ ?>
            <td>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['fw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            </td>
            <td>
                <?php echo CHtml::image("/images/userProfiles/".$data->to_user_id."/smallThumb/".$data->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
            </td>
        <?php } else {  ?>
            <td>
                <?php echo CHtml::image("/images/userProfiles/".$data->from_user_id."/smallThumb/".$data->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
            </td>
            <td>
                <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$data->message_type]['bw']); ?></span>
                <?php echo CHtml::link($data->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
            </td>
        <?php } ?>
    <?php }  ?>
</tr>