<?php
/* @var $this LotteriesController */
/* @var $data Lotteries */
?>
<div class="span4">
    <?php if(!empty($model->id)){ ?>
      <?php $this->renderPartial('_galleryImage',array('data'=>$model,'img'=>$img)); ?>
    <?php } ?>
</div>
<div class="span8">
    <h1><?php echo $model->name; ?></h1>
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
        <div id="data-<?php echo $model->id; ?>">
            <?php $this->renderPartial('_buyAjax'); ?>
        </div>
    </div>
    
    <?php $this->beginWidget(
        'bootstrap.widgets.TbBox',
        array(
            'title' => Yii::t('lot','prize'),
            'headerIcon' => 'icon-gift',
            'htmlOptions' => array('class' => 'prize-box')
        )
    ); ?>
    <div class="row">
    <div class="span4"></div>
    <div class="prize-desc-text span8">
        <?php echo $model->prize_desc; ?>
    </div>
    </div>
    <div class="row">
    <div class="prize-label span4"></div>
    <div class="prize-cat-text span8">
        <?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($model->prize_category)); ?>
    </div>
    </div>
    <div class="row">
    <div class="prize-cond-text-label span4"><?php echo Yii::t('lot','prize conditions'); ?>:</div>
    <div class="prize-cond-text span8">
        <?php echo CHtml::encode($model->prize_conditions); ?>
    </div>
    <div class="row">
    <div class="prize-ship-text-label span4"><?php echo Yii::t('lot','prize shipping'); ?>:</div>
    <div class="prize-ship-text span8">
        <?php echo CHtml::encode($model->prize_shipping); ?>
    </div>
    </div>

    <?php $this->endWidget(); ?>
    
    <?php $this->beginWidget(
        'bootstrap.widgets.TbBox',
        array(
            'title' => Yii::t('lot','lottery type'),
            'headerIcon' => 'icon-ticket',
            'htmlOptions' => array('class' => 'lottery-type-box')
        )
    ); ?>
    <div class="span4"></div>
    <div class="span8"></div>

    <div class="lottery-type-text">
        <?php echo CHtml::encode(Yii::app()->params['lotteryTypes'][$model->lottery_type]['name']); ?>
    </div>
    <div class="lottery-type-desc">
        <?php echo CHtml::encode(Yii::app()->params['lotteryTypes'][$model->lottery_type]['desc']); ?>
    </div>

    <div class="status-text">
        <div class="status-text-label"><?php echo Yii::t('lot','status'); ?>:</div>
        <?php echo CHtml::encode($model->getStatusText()); ?>
    </div>

    <?php if($model->isFixTime()){ ?>
        <div class="start-date-text">
            <div class="start-date-text-label"><?php echo Yii::t('lot','start date'); ?>:</div>
            <?php echo CHtml::encode($model->lottery_start_date); ?>
        </div>
        <div class="draw-date-text">
            <div class="draw-date-text-label"><?php echo Yii::t('lot','draw date'); ?>:</div>
            <?php echo CHtml::encode($model->lottery_draw_date); ?>
        </div>
    <?php } ?>

    <div class="min-ticket-text">
        <div class="min-ticket-text-label"><?php echo Yii::t('lot','min tickets'); ?>:</div>
        <span class="badge badge-success"><?php echo CHtml::encode($model->min_ticket); ?></span>
    </div>

    <div class="max-ticket-text">
        <div class="max-ticket-text-label"><?php echo Yii::t('lot','max tickets'); ?>:</div>
        <span class="badge badge-success"><?php echo CHtml::encode($model->max_ticket); ?></span>
    </div>

    <div class="val-ticket-text">
        <div class="val-ticket-text-label"><?php echo Yii::t('lot','val tickets'); ?>:</div>
        <span class="badge badge-success"><?php echo CHtml::encode($model->ticket_value); ?></span>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbProgress',
        array(
            'percent' => $model->getPerc(), // the progress
            'striped' => true,
            'animated' => true,
        )
    ); ?>

    <?php $this->endWidget(); ?>
</div>

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