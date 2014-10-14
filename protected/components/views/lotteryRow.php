<tr class="lot-item" id="<?php echo $data->id; ?>">
    <td>
        <div class="row">
            <div class="list-img">
                <?php echo CHtml::image(Yii::app()->controller->getImageUrl($data,'smallThumb'),'Lottery Image'); ?>
            </div>
            <div class="list-text">
                <p><span class="lot-b-text"><?php echo CHtml::encode($data->name); ?></span></p>
                <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->getStatusText()); ?></span></p>
                <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->lottery_draw_date); ?></span></p>
            </div>
        </div>
        <div class="row ticket-block" id="ticket-lot-<?php echo $data->id; ?>">
            <!--<div class="small-row-scroll">--> <!-- for small row scroller inside ticket block -->
            <div class="">
                <?php $this->widget('ticketsWidget',array('tickets'=>$data->tickets)); ?>
            </div>
        </div>
    </td>
</tr>