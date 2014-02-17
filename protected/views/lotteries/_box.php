<?php
/* @var $this LotteriesController */
/* @var $data Lotteries */
?>

<div class="panel panel-default bootstrap-widget-table isotope-item">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo Yii::t('wonlot',$title);?></h3>
    </div>
    <div class="panel-body">
      <?php if($data->prize_img){ ?>
        <div class="lot-box-body">
            <div class=""><?php echo CHtml::image($this->getImageUrl($data->id, $data->prize_img,'mediumSquaredThumb'),'Lottery Image'); ?></div>
        </div>
      <?php } ?>
        <div class="lot-box-body">
            <div class=""><?php echo CHtml::encode(Yii::app()->params['lotteryTypes'][$data->lottery_type]['name']); ?></div>
            <div class=""><b>Prize:</b><?php echo $data->prize_desc; ?></div>
            <div class=""><b>Category:</b><?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($data->prize_category)); ?></div>
            <div class=""><b>Tickets</b></div>
            <div class="">Value: <?php echo CHtml::encode($data->ticket_value); ?> euro</div>
            <div class="">Total: <?php echo CHtml::encode($data->max_ticket); ?></div>
            <div class="">Sold: <?php echo CHtml::encode($data->ticket_sold); ?></div>
            <div class="">Remaining: <?php echo CHtml::encode($data->max_ticket-$data->ticket_sold); ?></div>
            <?php if($data->lottery_type === Yii::app()->params['lotteryTypesConst']['fixTime']){ ?>
                    <div class=""><b>Lottery draw date:</b><?php echo CHtml::encode($data->lottery_draw_date); ?></div>
            <?php } ?>
                    <button type="button" class="btn btn-primary"><?php echo CHtml::link('Edit', 'lotteries/update/'+$data->id);?></button>
        </div>
    </div>
</div>