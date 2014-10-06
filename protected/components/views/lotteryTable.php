<div class="main-table col-md-12">
    <table class="table table-hover">
        <?php foreach($tickets as $m){ ?>
        <tr class="lot-item">
            <td>
                <div class="row">
                    <div class="list-img">
                        <?php echo CHtml::image(Yii::app()->controller->getImageUrl($m,'smallThumb'),'Lottery Image'); ?>
                    </div>
                    <div class="list-text">
                        <p><span class="lot-b-text"><?php echo CHtml::encode($m->name); ?></span></p>
                        <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->getStatusText()); ?></span></p>
                        <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->lottery_draw_date); ?></span></p>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary ticket-list-btn" id="<?php echo $m->id; ?>"><em class="glyphicon glyphicon-th-list"></em></button>
                    </div>
                </div>
                <div class="row ticket-block" id="ticket-lot-<?php echo $m->id; ?>">
                    <!--<div class="small-row-scroll">--> <!-- for small row scroller inside ticket block -->
                    <div class="">
                        <?php $this->widget('ticketsWidget',array('tickets'=>$m->tickets)); ?>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>  