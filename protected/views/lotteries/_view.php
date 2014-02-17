<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */
?>
<div class="panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php $model->name;?></h3>
    </div>
    <div class="panel-body">
        <?php if(!empty($model->id)){ ?>
            <?php $this->renderPartial('_galleryImage',array('data'=>$model,'img'=>$img)); ?>
        <?php } ?>
        <div class="val-ticket-text">
        <div class="val-ticket-text-label"><?php echo Yii::t('lot','val tickets'); ?>:</div>
            <span class="badge badge-success"><?php echo CHtml::encode($model->ticket_value); ?></span>
        </div>

        <div class="status-text">
            <div class="status-text-label"><?php echo Yii::t('lot','status'); ?>:</div>
            <?php echo CHtml::encode($model->getStatusText()); ?>
        </div>

        <div class="start-date-text">
            <div class="start-date-text-label"><?php echo Yii::t('lot','start date'); ?>:</div>
            <?php echo CHtml::encode($model->lottery_start_date); ?>
        </div>
        <div class="draw-date-text">
            <div class="draw-date-text-label"><?php echo Yii::t('lot','draw date'); ?>:</div>
            <?php echo CHtml::encode($model->lottery_draw_date); ?>
        </div>

        <?php if($model->max_ticket){ ?>
            <div class="max-ticket-text">
                <div class="max-ticket-text-label"><?php echo Yii::t('lot','max tickets'); ?>:</div>
                <span class="badge badge-success"><?php echo CHtml::encode($model->max_ticket); ?></span>
            </div>
        <?php } ?>

        <?php if($model->prize_price){ ?>
            <div class="val-ticket-text">
                <div class="val-ticket-text-label"><?php echo Yii::t('lot','prize value'); ?>:</div>
                <span class="badge badge-success"><?php echo CHtml::encode($model->prize_price); ?></span>
            </div>
        <?php } ?>
        <div class="prize-desc-text">
            <?php echo $model->prize_desc; ?>
        </div>
        <div class="prize-cat-text-label"><?php echo Yii::t('lot','prize category'); ?>:</div>
        <div class="prize-cat-text">
            <?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($model->prize_category)); ?>
        </div>

        <div class="prize-cond-text-label"><?php echo Yii::t('lot','prize conditions'); ?>:</div>
        <div class="prize-cond-text">
            <?php echo CHtml::encode($model->prize_conditions); ?>
        </div>

        <div class="prize-ship-text-label"><?php echo Yii::t('lot','prize shipping'); ?>:</div>
        <div class="prize-ship-text">
            <?php echo CHtml::encode($model->prize_shipping); ?>
        </div>
        <?php echo CHtml::ajaxButton ("Buy for You!",
            CController::createUrl('site/socialShare'), 
            array('update' => '.data-'.$data->id,
              'type' => 'POST', 
              'data'=>'js:jQuery(this).parents("form").serialize()'
            )); ?>
    </div>
</div>
<?php $this->renderPartial('_buyModal',array('data'=>$model, 'addData' => $addData)); ?>