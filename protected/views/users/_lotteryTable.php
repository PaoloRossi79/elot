<?php $tickets = Tickets::model()->getMyTicketsByAllLottery($data->id);?>
    
    <tr class="lot-item" id="my-ticket-list">
        <td>
            <div class="row">
                <div class="list-img img-thumbnail">
                    <?php echo CHtml::image(Yii::app()->controller->getImageUrl($data,'smallThumb'),'Lottery Image'); ?>
                </div>
                <div class="list-text">
                    <p><span class="lot-b-text"><?php echo CHtml::encode($data->name); ?></span></p>
                    <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->getStatusText()); ?></span></p>
                    <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->lottery_draw_date); ?></span></p>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary ticket-list-btn" id="<?php echo $data->id; ?>"><em class="glyphicon glyphicon-th-list"></em></button>
                </div>
            </div>
            <div class="row ticket-block" id="ticket-lot-<?php echo $data->id; ?>">
                <!--<div class="small-row-scroll">--> <!-- for small row scroller inside ticket block -->
                <div class="">
                    <?php $this->widget('ticketsWidget',array('lotId'=>$data->id,'tickets'=>$tickets)); ?>
                </div>
            </div>
        </td>
    </tr>