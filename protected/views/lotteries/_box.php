<?php
/* @var $this LotteriesController */
/* @var $data Lotteries */
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => "<b>".CHtml::link($data->name, CController::createUrl('lotteries/view/'.$data->id))."</b>",
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table isotope-item'),
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'primary',
                'buttons' => array(
                    array(
                        'label' => 'Edit', 
                        'buttonType' => 'link', 
                        //'url' => CController::createUrl('lotteries/update',$data->id), 
                        'url' => '/index.php/lotteries/update/'.$data->id,
                    ),
                    // this makes it split :)
                )
            ),
        )
    )
);?>
<div class="">
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

        <div class=""></div>
    </div>
</div>
<?php $this->endWidget(); ?>