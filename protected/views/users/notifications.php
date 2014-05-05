<div class="modal-body">
    <div class="box-spinner">
        <table class="load-inside"><tr><td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/loading-dots.gif", "Loading"); ?>
        </td></tr></table>
    </div>
    <table class="table table-hover">

    <?php 
        $notify = Notifications::model()->getLastNotifications();
        $unreadNotifyCount = Notifications::model()->getCountUnreadNotifications();
        foreach($notify as $no){
            $isReadClass = ($no->to_user_id == Yii::app()->user->id && !$no->message_read) ? "notify-unread" : "notify-read";
    ?>
        <tr class="notify-row <?php echo $isReadClass; ?>" name="<?php echo $no->id; ?>">
            <?php if(in_array($no->message_type,$no->related['ticket'])){?>
                <td>
                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "Ticket", array("class"=>"img-responsive")); ?>
                </td>
                <td>
                    <?php if($no->to_user_id == Yii::app()->user->id){ ?>
                        <?php echo CHtml::image("/images/userProfiles/".$no->from_user_id."/smallThumb/".$no->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                        <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['fw']); ?></span>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('tickets/view/'.$no->message_value)); ?>
                    <?php } else {  ?>
                        <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['bw']); ?></span>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('tickets/view/'.$no->message_value)); ?>
                        <span> a: </span>
                        <?php echo CHtml::image("/images/userProfiles/".$no->to_user_id."/smallThumb/".$no->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                        <span><?php echo CHtml::encode($no->toUser->username); ?></span>
                    <?php }   ?>
                </td>
            <?php } elseif(in_array($no->message_type,$no->related['money'])){ ?>
                <td>
                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/wl-money.png", "WlMoney", array("class"=>"img-responsive")); ?>
                </td>
                <td>
                    <?php if($no->to_user_id == Yii::app()->user->id){ ?>
                        <?php echo CHtml::image("/images/userProfiles/".$no->from_user_id."/smallThumb/".$no->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                        <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['fw']); ?></span>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                    <?php } else {  ?>
                        <span><?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['bw']); ?></span>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                        <span> a: </span>
                        <?php echo CHtml::image("/images/userProfiles/".$no->to_user_id."/smallThumb/".$no->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                        <span><?php echo CHtml::encode($no->toUser->username); ?></span>
                    <?php }  ?>
                    
                </td>
            <?php } else { ?>
                <?php if($no->from_user_id == Yii::app()->user->id){ ?>
                    <td>
                        <?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['fw']); ?>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                    </td>
                    <td>
                        <?php echo CHtml::image("/images/userProfiles/".$no->to_user_id."/smallThumb/".$no->toUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                    </td>
                <?php } else {  ?>
                    <td>
                        <?php echo CHtml::image("/images/userProfiles/".$no->from_user_id."/smallThumb/".$no->fromUser->profile->img, "User Avatar", array("class"=>"img-thumbnail")); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode(Yii::app()->params['notifyTypeMsg'][$no->message_type]['bw']); ?>
                        <?php echo CHtml::link($no->message_value, Yii::app()->controller->createUrl('users/myProfile')); ?>
                    </td>
                <?php } ?>
            <?php }  ?>
        </tr>
    <?php } ?>
    </table>
</div>
<div class="modal-footer">
    <?php echo CHtml::link(Yii::t('wonlot','Mostra tutte'), Yii::app()->controller->createUrl('users/allNotify')); ?>
</div>
<script>
    $('.box-spinner').hide();
    $('.notify-unread-count').html(<?php echo $unreadNotifyCount; ?>);
</script>
<?php if(!($unreadNotifyCount > 0)){?>
    <script>
        $('.float-circle').hide(); 
    </script>
<?php }  ?>