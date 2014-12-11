<?php
/* @var $this AuctionsController */
/* @var $data Auctions */
$boxTitle="<b>".CHtml::link($data->name, CController::createUrl('auctions/view/'.$data->id))."</b>";
/*if($showCat){
    $boxTitle.=" - ".CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($data->prize_category));
}*/
?>
<div class="panel panel-default bootstrap-widget-table lot-box">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $boxTitle;?></h3>
    </div>
    <div class="panel-body">
        <div class="lot-box-img">
            <?php if($data->prize_img){ ?>
                <div class=""><?php echo CHtml::image($this->getImageUrl($data,'mediumSquaredThumb'),'Lottery Image'); ?></div>
            <?php } ?>
        </div>

        <div class="lot-box-body">
            <?php if(!$showCat){ ?>
                <div class=""><b>Category:</b><?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($data->prize_category)); ?></div>
            <?php } ?>
            <div class=""><?php echo $data->prize_desc; ?></div>
            <div class="">Value: <?php echo CHtml::encode($data->prize_price); ?> euro</div>
            <div class="">Ticket Price: <?php echo CHtml::encode($data->ticket_value); ?></div>
            <?php if($data->lottery_type === Yii::app()->params['lotteryTypesConst']['fixTime']){ ?>
                    <div class=""><b>Lottery draw date:</b><?php echo CHtml::encode($data->lottery_draw_date); ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#<?php echo 'buyModal-'.$data->id;?>">
            <?php echo Yii::t('wonlot','Buy ticket'); ?>
        </button>
    </div>
</div>

<?php $this->renderPartial('_buyModal',array('data'=>$data, 'addData' => $addData)); ?>