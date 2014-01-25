<?php
/* @var $this LotteriesController */
/* @var $data Lotteries */
$boxTitle="<b>".CHtml::link($data->name, CController::createUrl('lotteries/view/'.$data->id))."</b>";
/*if($showCat){
    $boxTitle.=" - ".CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($data->prize_category));
}*/
?>
<?php $box = $this->beginWidget(
    'bootstrap.widgets.TbBox',
    array(
        'title' => $boxTitle,
        'headerIcon' => 'icon-ticket',
        'htmlOptions' => array('class' => 'bootstrap-widget-table isotope-item lot-box'),
        'headerButtons' => array(
            array(
                'class' => 'bootstrap.widgets.TbButtonGroup',
                'type' => 'primary',
                // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                /*'buttons' => array(
                    array(
                        'label' => 'Buy Ticket', 
                        'buttonType' => 'button', 
                        //'url' => CController::createUrl('lotteries/buyTicket/'.$data->id), 
                        'htmlOptions' => array(
                            'id' => $data->id, 
                            'class' => 'buyButton',
                            'data-toggle' => 'modal',
                            'data-target' => '#buyModal-'.$data->id,
                        ),
                    ),
                    // this makes it split :)
                )*/
            ),
        )
    )
);?>

<div class="lot-box-img">
    <?php if($data->prize_img){ ?>
        <div class=""><?php echo CHtml::image($this->getImageUrl($data->id, $data->prize_img,'mediumSquaredThumb'),'Lottery Image'); ?></div>
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
    <div class="button-div">
        <?php // echo CHtml::ajaxSubmitButton(Yii::t('app', 'Search')); 
        
            $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'buttonType' => 'submit', 
                    'label' => 'Buy ticket', 
                    'htmlOptions' => array(
                        'id' => $data->id, 
                        'class' => 'buyButton',
                        'data-toggle' => 'modal',
                        'data-target' => '#buyModal-'.$data->id,
                    ),
                )
            );
        
        ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php $this->renderPartial('_buyModal',array('data'=>$data, 'addData' => $addData)); ?>