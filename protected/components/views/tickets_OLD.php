<input type="hidden" value="" id="ticketIdForGift">
<div class="col-md-12">
    <button type="button" class="sel-btn btn btn-success btn-xs" name="-1"><?php echo Yii::t('wonlot','Tutti'); ?></button>
    <button type="button" class="sel-btn btn btn-success btn-xs" name="0"><?php echo Yii::t('wonlot','Disponibili'); ?></button>
    <button type="button" class="sel-btn btn btn-success btn-xs" name="1"><?php echo Yii::t('wonlot','Regalati'); ?></button>
    <button type="button" class="sel-btn btn btn-success btn-xs" name="2"><?php echo Yii::t('wonlot','Ricevuti'); ?></button>
</div>
<script>
    $('.sel-btn').filter('[name=-1]').removeClass('btn-success');
    $('.sel-btn').filter('[name=-1]').addClass('btn-primary');
    $('.sel-btn').filter('[name=-1]').attr('disabled','disabled');
    jQuery('body').on('click','.sel-btn',function(){
        var boxActive = $(this).attr('name');
        if(boxActive == "-1"){
            $('.ticket-lot').fadeIn();
        } else {
            $('.ticket-lot').filter('[name='+boxActive+']').fadeIn();
            $('.ticket-lot').not('[name='+boxActive+']').fadeOut();
        }
        $('.sel-btn').filter('[name='+boxActive+']').removeClass('btn-success');
        $('.sel-btn').filter('[name='+boxActive+']').addClass('btn-primary');
        $('.sel-btn').filter('[name='+boxActive+']').attr('disabled','disabled');
        $('.sel-btn').not('[name='+boxActive+']').addClass('btn-success');
        $('.sel-btn').not('[name='+boxActive+']').removeClass('btn-primary');
        $('.sel-btn').not('[name='+boxActive+']').removeAttr('disabled');
    });
</script>
<?php foreach($this->tickets as $ticket){ ?>
    <?php if($ticket->is_gift == 1){ 
        if($ticket->gift_from_id != $this->userId){
            $selection = 2;
        } else {
            $selection = 1;
        }
    } else {
        $selection = 0;
    }
    ?>
    <div class="ticket-lot" id="ticket-lot-<?php echo $ticket->id; ?>" name="<?php echo $selection; ?>">
        <?php if($ticket->lottery->winner_ticket_id == $ticket->id){ ?>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/winner.png", "Winner", array("class"=>"winner-ban")); ?>
        <?php } ?>
        <?php echo CHtml::link($ticket->serial_number, Yii::app()->createAbsoluteUrl('tickets/view/'.$ticket->id), array('class'=> 'ticket-number-text')); ?>
        <?php if($ticket->is_gift == 1){ ?>
            <?php if($ticket->gift_from_id != $this->userId){ ?>
                <?php $giftText = Yii::t('wonlot','Regalato da ').$ticket->giftFromUser->username; ?>
                <span class="ticket-gift-text bg-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $giftText; ?>"><?php echo Yii::t('wonlot','In regalo!'); ?></span>
            <?php } else { ?>
                <?php if($ticket->user_id == $this->userId){ ?>
                    <?php $giftText = Yii::t('wonlot','Regalato a ').$ticket->gift_ext_username; ?>
                <?php } else { ?>
                    <?php $giftText = Yii::t('wonlot','Regalato a ').$ticket->user->username; ?>
                <?php } ?>
                <span class="ticket-gift-text bg-success" data-toggle="tooltip" data-placement="bottom" title="<?php echo $giftText; ?>"><?php echo Yii::t('wonlot','Regalato!'); ?></span>
            <?php } ?>
        <?php } else { ?>
            <?php if($ticket->lottery->status == Yii::app()->params['lotteryStatusConst']['open']){ ?>
                <button id="<?php echo $ticket->id; ?>" class="btn btn-success btn-xs set-gift ticket-gift-btn"><i class="glyphicon glyphicon-search">Regala</i></button> 
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>