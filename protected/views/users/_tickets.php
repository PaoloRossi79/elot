<div id="user-tickets">
        
    <h2><?php echo Yii::t('wonlot','Ticket'); ?></h2>
    <div class="main-table col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><?php echo Yii::t('wonlot','Lotteria'); ?></td>
                </tr>
            </thead>
            <?php foreach($tickets as $m){ ?>
            <tr class="lot-item" id="<?php echo $m->id; ?>">
                <td>
                    <div class="row">
                        <div class="list-img">
                            <?php echo CHtml::image($this->getImageUrl($m,'smallThumb'),'Lottery Image'); ?>
                        </div>
                        <div class="list-text">
                            <p><span class="lot-b-text"><?php echo CHtml::encode($m->name); ?></span></p>
                            <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->getStatusText()); ?></span></p>
                            <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->lottery_draw_date); ?></span></p>
                        </div>
                    </div>
                    <div class="row ticket-block" id="ticket-lot-<?php echo $m->id; ?>">
                        <!--<div class="small-row-scroll">--> <!-- for small row scroller inside ticket block -->
                        <div class="">
                                <?php foreach($m->tickets as $t){ ?>
                                    <div class="ticket-lot">
                                        <?php if($m->winner_ticket_id == $t->id){ ?>
                                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/winner.png", "Winner", array("class"=>"winner-ban")); ?>
                                        <?php } ?>
                                        <?php echo CHtml::link($t->serial_number, CController::createUrl('tickets/view/'.$t->id), array('class'=> 'ticket-number-text')); ?>
                                    </div>
                                <?php } ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>    
</div>