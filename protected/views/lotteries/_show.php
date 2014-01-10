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

<?php $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'buyModal-'.$data->id)
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Modal header</h4>
    </div>

    <?php /** @var TbActiveForm $form */
    $friendModel = new Users;
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'horizontalForm',
            'type' => 'horizontal',
        )
    ); ?>
    <div class="modal-body">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'buttonType' => 'ajaxLink',
                'label' => 'Buy for You!',
                'url' => CController::createUrl('lotteries/buyTicket/'.$data->id), 
                'ajaxOptions' => array(
                    'update' => '#data-'.$data->id,
                ),
            )
        ); ?>
        <p> OR </p>
        <?php echo $form->textFieldRow(
            $friendModel,
            'email',
            array('hint' => 'Your friend email...')
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'buttonType' => 'ajaxSubmit',
                'label' => 'Buy for a friend!',
                'url' => CController::createUrl('lotteries/buyTicket/'.$data->id), 
                'ajaxOptions' => array(
                    'update' => '#data-'.$data->id,
                    'type' => 'POST', 
                    'data'=>'js:jQuery(this).parents("form").serialize()',
                ),
            )
        ); ?>
    </div>
    <?php $this->endWidget(); ?>

    <div class="modal-footer">
        
        <div class="">
            <div id="data-<?php echo $data->id; ?>">
                <?php $this->renderPartial('_buyAjax',$data); ?>
            </div>
        </div>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => 'Close',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
<?php $this->endWidget(); ?>