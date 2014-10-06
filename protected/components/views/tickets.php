<input type="hidden" value="" id="ticketIdForGift">
<div class="col-md-12">
    <ul class="nav nav-tabs" id="profile-tabs">
        <li class="profile-tab-item width-50perc active">
            <a id="myTickets-<?php echo $ticket->id; ?>" href="#myTicketsTab" data-toggle="tab" class="btn btn-info"><span class="badge"><em class="glyphicon glyphicon-user"></em></span><?php echo Yii::t('wonlot','Disponibili'); ?></a>
        </li>
        <li class="profile-tab-item width-50perc">
            <a id="giftTickets-<?php echo $ticket->id; ?>" href="#giftTicketsTab" data-toggle="tab" class="btn"><span class="badge"><em class="glyphicon glyphicon-euro"></em></span><?php echo Yii::t('wonlot','Regalati'); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="myTicketsTab">
            <?php if(count($myTickets) > 0){ ?>
                <?php foreach($myTickets as $ticket){ ?>
                    <div class="ticket-lot" id="ticket-lot-<?php echo $ticket->id; ?>">
                        <?php echo CHtml::link($ticket->random_weight, Yii::app()->createAbsoluteUrl('tickets/view/'.$ticket->id), array('class'=> 'ticket-number-text')); ?>
                        <?php if($ticket->is_gift == 1){ ?>
                            <?php $giftText = Yii::t('wonlot','Regalato da ').$ticket->giftFromUser->username; ?>
                            <span class="ticket-gift-text bg-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $giftText; ?>"><?php echo Yii::t('wonlot','In regalo!'); ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } else {?>
                <div class="ticket-lot"></div>
            <?php }?>
        </div>
        <div class="tab-pane fade" id="giftTicketsTab">
            <?php if(count($toGiftTickets) > 0){ ?>
                <?php foreach($toGiftTickets as $ticket){ ?>
                    <div class="ticket-lot" id="ticket-lot-<?php echo $ticket->id; ?>">
                        <?php echo CHtml::link($ticket->random_weight, Yii::app()->createAbsoluteUrl('tickets/view/'.$ticket->id), array('class'=> 'ticket-number-text')); ?>
                        <?php if($ticket->user_id == $this->userId){ ?>
                            <?php $giftText = Yii::t('wonlot','Regalato a ').$ticket->gift_ext_username; ?>
                        <?php } else { ?>
                            <?php $giftText = Yii::t('wonlot','Regalato a ').$ticket->user->username; ?>
                        <?php } ?>
                        <span class="ticket-gift-text bg-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $giftText; ?>"><?php echo Yii::t('wonlot','Regalato!'); ?></span>
                    </div>
                <?php } ?>
            <?php } else {?>
                <div class="ticket-lot"></div>
            <?php }?>
        </div>
    </div>
</div>