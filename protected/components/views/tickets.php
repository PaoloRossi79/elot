<input type="hidden" value="" id="ticketIdForGift">
<?php foreach($this->tickets as $ticket){ ?>
    <div class="ticket-lot" id="ticket-lot-<?php echo $ticket->id; ?>">
        <?php if($m->winner_ticket_id == $ticket->id){ ?>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/winner.png", "Winner", array("class"=>"winner-ban")); ?>
        <?php } ?>
        <?php echo CHtml::link($ticket->serial_number, Yii::app()->createAbsoluteUrl('tickets/view/'.$ticket->id), array('class'=> 'ticket-number-text')); ?>
        <?php if($ticket->is_gift == 1){ ?>
            <span class="ticket-gift-text bg-success">Regalato!</span>
        <?php } else { ?>
            <button id="<?php echo $ticket->id; ?>" class="btn btn-success btn-xs set-gift ticket-gift-btn"><i class="glyphicon glyphicon-search">Regala</i></button> 
        <?php } ?>
    </div>
<?php } ?>