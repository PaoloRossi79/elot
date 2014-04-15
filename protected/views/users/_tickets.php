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
                    <div class="list-img">
                        <?php echo CHtml::image($this->getImageUrl($m,'smallThumb'),'Lottery Image'); ?>
                    </div>
                    <div class="list-text">
                        <p><span class="lot-b-text"><?php echo CHtml::encode($m->name); ?></span></p>
                        <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->getStatusText()); ?></span></p>
                        <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->lottery_draw_date); ?></span></p>
                    </div>
                </td>
            </tr>
            <tr id="ticket-lot-<?php echo $m->id; ?>" class="ticket-lot">
                <td>
                    <?php foreach($m->tickets as $t){ ?>
                        <p><?php echo CHtml::encode($t->serial_number); ?></p>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>    
</div>