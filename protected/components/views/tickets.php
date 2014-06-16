<input type="hidden" value="" id="ticketIdForGift">
<div class="col-md-12">
    <ul class="nav nav-tabs" id="profile-tabs">
        <li class="profile-tab-item width-50perc active">
            <a id="profileButton1" href="#myTicketsTab" data-toggle="tab" class="btn btn-info"><span class="badge"><em class="glyphicon glyphicon-user"></em></span><?php echo Yii::t('wonlot','Disponibili'); ?></a>
        </li>
        <li class="profile-tab-item width-50perc">
            <a id="profileButton2" href="#giftTicketsTab" data-toggle="tab" class="btn"><span class="badge"><em class="glyphicon glyphicon-euro"></em></span><?php echo Yii::t('wonlot','Regalati'); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="myTicketsTab">
            <?php foreach($myTickets as $ticket){ ?>
                <div class="ticket-lot" id="ticket-lot-<?php echo $ticket->id; ?>">
                    <?php echo CHtml::link($ticket->random_weight, Yii::app()->createAbsoluteUrl('tickets/view/'.$ticket->id), array('class'=> 'ticket-number-text')); ?>
                    <?php if($ticket->is_gift == 1){ ?>
                        <?php $giftText = Yii::t('wonlot','Regalato da ').$ticket->giftFromUser->username; ?>
                        <span class="ticket-gift-text bg-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $giftText; ?>"><?php echo Yii::t('wonlot','In regalo!'); ?></span>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="tab-pane fade" id="giftTicketsTab">
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
        </div>
    </div>
</div>
<script>
    /*jQuery('body').on('click','.sel-btn',function(){
        var boxActive = $(this).attr('name');
        $('.ticket-lot').filter('[name='+boxActive+']').fadeIn();
        $('.ticket-lot').not('[name='+boxActive+']').fadeOut();
        $('.sel-btn').filter('[name='+boxActive+']').removeClass('btn-success');
        $('.sel-btn').filter('[name='+boxActive+']').addClass('btn-primary');
        $('.sel-btn').filter('[name='+boxActive+']').attr('disabled','disabled');
        $('.sel-btn').not('[name='+boxActive+']').addClass('btn-success');
        $('.sel-btn').not('[name='+boxActive+']').removeClass('btn-primary');
        $('.sel-btn').not('[name='+boxActive+']').removeAttr('disabled');
    });
    $('.ticket-lot').filter('[name=0]').fadeIn();
    $('.ticket-lot').not('[name=0]').fadeOut();
    $('.sel-btn').filter('[name=0]').removeClass('btn-success');
    $('.sel-btn').filter('[name=0]').addClass('btn-primary');
    $('.sel-btn').filter('[name=0]').attr('disabled','disabled');*/
    
</script>