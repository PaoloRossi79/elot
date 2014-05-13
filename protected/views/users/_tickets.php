<div id="user-tickets">
        
    <h2><?php echo Yii::t('wonlot','Ticket'); ?></h2>
    <div class="panel panel-default bootstrap-widget-table">
        <?php $this->widget('lotteryWidget',array('tickets'=>$tickets)); ?>  
    </div>    
</div>
<?php $this->renderPartial('/lotteries/_giftModal'); ?>