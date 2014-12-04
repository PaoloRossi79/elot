<div id="user-tickets">
    <h2><?php echo Yii::t('wonlot','Ticket'); ?></h2>
    <div class="panel panel-default bootstrap-widget-table" id="tickets-table">
        <table class="fullPageTable">
            <?php foreach($tickets["lotteries"] as $ticket){ ?>
                <tr class="lot-item" id="my-ticket-list">
                    <td>
                        <div class="row">
                            <div class="list-img img-thumbnail">
                                <?php echo CHtml::image(Yii::app()->controller->getImageUrl($ticket,'smallThumb'),'Lottery Image'); ?>
                            </div>
                            <div class="list-text">
                                <p><span class="lot-b-text"><?php echo CHtml::encode($ticket->name); ?></span></p>
                                <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($ticket->getStatusText()); ?></span></p>
                                <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($ticket->lottery_draw_date); ?></span></p>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary ticket-list-btn" id="<?php echo $ticket->id; ?>"><em class="glyphicon glyphicon-th-list"></em></button>
                            </div>
                        </div>
                        <div class="row ticket-block" id="ticket-lot-<?php echo $ticket->id; ?>">
                            <!--<div class="small-row-scroll">--> <!-- for small row scroller inside ticket block -->
                            <div class="">
                                <?php $showTickets = Tickets::model()->getMyTicketsByAllLottery($ticket->id);?>
                                <?php $this->widget('ticketsWidget',array('lotId'=>$ticket->id,'tickets'=>$showTickets)); ?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>    
</div>