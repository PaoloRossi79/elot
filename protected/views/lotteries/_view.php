<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */
?>
    <div class="span4">
        <h1><?php echo $model->name; ?></h1>
        <div class="button-div">
            <?php // echo CHtml::ajaxSubmitButton(Yii::t('app', 'Search')); 
                $this->widget(
                    'bootstrap.widgets.TbButton',
                    array(
                        'buttonType' => 'submit', 
                        'label' => 'Buy ticket', 
                        'htmlOptions' => array(
                            'id' => $model->id, 
                            'class' => 'buyButton',
                            'data-toggle' => 'modal',
                            'data-target' => '#buyModal-'.$model->id,
                        ),
                    )
                );
            ?>
            <div class="data-<?php echo $model->id; ?>">
                <?php 
                    $addData = array('data' => $model);
                    $this->renderPartial('_buyAjax', $addData); 
                ?>
            </div>
        </div>
    </div>
    
        <?php if(!empty($model->id)){ ?>
            <?php $this->renderPartial('_galleryImage',array('data'=>$model,'img'=>$img)); ?>
        <?php } ?>
    
    <?php $this->beginWidget(
        'bootstrap.widgets.TbBox',
        array(
            'title' => Yii::t('lot','prize'),
            'headerIcon' => 'icon-gift',
            'htmlOptions' => array('class' => 'prize-box')
        )
    ); ?>
    <div class="clearfix"></div>
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
    array('id' => 'buyModal-'.$model->id)
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Modal header</h4>
    </div>
    <?php if($this->userCanBuy($model->id)){ ?>
        <?php /** @var TbActiveForm $form */
        $friendModel = new Users;
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'horizontalForm',
                'type' => 'horizontal',
            )
        ); 
        echo CHtml::hiddenField('lotId', $model->id);
        ?>
        <div class="modal-body">
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'type' => 'primary',
                    'buttonType' => 'ajaxLink',
                    'label' => 'Buy for You!',
                    'url' => CController::createUrl('lotteries/buyTicket'), 
                    'ajaxOptions' => array(
                        'update' => '.data-'.$model->id,
                        'type' => 'POST', 
                        'data'=>'js:jQuery(this).parents("form").serialize()',
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
                    'url' => CController::createUrl('lotteries/buyTicket'), 
                    'ajaxOptions' => array(
                        'update' => '.data-'.$model->id,
                        'type' => 'POST', 
                        'data'=>'js:jQuery(this).parents("form").serialize()',
                    ),
                )
            ); ?>
        </div>
        <?php $this->endWidget(); ?>

        <div class="modal-footer">

            <div class="">
                <div class="data-<?php echo $model->id; ?>">
                    <?php 
                        $addData = array('version' => 'complete', 'data' => $model);
                        $this->renderPartial('_buyAjax', $addData); 
                    ?>
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
    <?php } elseif($model->owner_id === Yii::app()->user->id){ ?>
        <h4>CANNOT BUY YOUR LOTTERY!</h4>
    <?php } else { ?>
    <h4>LOGIN TO BUY!</h4>
        <?php $this->renderPartial('/site/login',array('showLogin'=>true)); ?>
    <?php } ?>
<?php $this->endWidget(); ?>