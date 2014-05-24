<div class="lot-box" id="<?php echo $data->id; ?>">
    <div>
        <div class="list-img">
            <?php echo CHtml::image(Yii::app()->controller->getImageUrl($data,'smallThumb'),'Lottery Image'); ?>
        </div>
    </div>
    <div>
        <div class="list-text">
            <p><span class="lot-b-text"><?php echo CHtml::encode($data->name); ?></span></p>
            <p><span class="">ID: <?php echo CHtml::encode($data->id); ?></span></p>
            <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->getStatusText()); ?></span></p>
            <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($data->lottery_draw_date); ?></span></p>
        </div>
    </div>
    <div>

    </div>
</div>