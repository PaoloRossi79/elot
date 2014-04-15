<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */
?>
<div class="lot-panel panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo CHtml::encode($model->name); ?></h3>
    </div>
    <div class="panel-body">
        <?php if(!empty($model->id)){ ?>
            <?php $this->renderPartial('_galleryImage',array('model'=>$model)); ?>
        <?php } ?>
        <div class="col-md-12">
            <h3><?php echo Yii::t("wonlot","Descrizione"); ?></h3>
            <div class="text-block">
                <?php echo CHtml::encode($model->prize_desc); ?>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Informazioni"); ?></h4>
            <div class="text-block">
                <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->getStatusText()); ?></span></p>
                <p><?php echo Yii::t("wonlot","Categoria:"); ?> 
                    <?php echo CHtml::image('/images/site/'.$model->category->image, $model->category->category_name,array('class'=>'cat-icon'));?> 
                    <span class="lot-b-text">
                        <?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($model->prize_category)); ?>
                    </span>
                </p>
                <p><?php echo Yii::t("wonlot","Data di apertura:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->lottery_start_date); ?></span></p>
                <p><?php echo Yii::t("wonlot","Data di estrazione:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->lottery_draw_date); ?></span></p>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Premio"); ?></h4>
            <div class="text-block">
                <p><?php echo Yii::t("wonlot","Città:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->location->address); ?></span></p>
                <p><?php echo Yii::t("wonlot","Stato:"); ?> 
                    <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['prizeConditionsId'][$model->prize_conditions]); ?></span><br/>
                    <span class="lot-i-text"><?php echo CHtml::encode($model->prize_condition_text); ?></span>
                </p>
                <p><?php echo Yii::t("wonlot","Consegna:"); ?> <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['speditionTypeId'][$model->prize_shipping]); ?></span></p>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Ticket"); ?></h4>
            <div class="text-block">
                <p>
                    <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                    <span class="lot-prize-text">
                        <?php echo CHtml::encode($model->ticket_value); ?>
                    </span>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if($model->owner->id == $this->userId){ ?>
            <div class="col-md-4">
                <h4><?php echo Yii::t("wonlot","Info per il venditore"); ?></h4>
                <div class="text-block">
                    <?php if($model->prize_price){ ?>
                        <p>
                            <?php echo Yii::t("wonlot","Valore premio:"); ?>
                            <span class="lot-b-text"><?php echo CHtml::encode($model->prize_price); ?></span>
                        </p>
                        <p>
                            BARRA PROGRESSO!
                        </p>
                    <?php } ?>
                    <p>
                        <?php echo Yii::t("wonlot","Incasso attuale:"); ?>
                        <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                        <span class="lot-b-text"><?php echo CHtml::encode($model->ticket_sold_value); ?></span>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <h4><?php echo Yii::t("wonlot","Condividi sul tuo sito!"); ?></h4>
                <div class="text-block">
                    <p>
                        <span class="lot-i-text">
                            <?php echo ""; ?>
                            Copia il testo qui in basso per creare un bottone per la tua lotteria sul tuo sito!
                        </span>
                    </p>
                </div>
            </div>
        <?php } ?>
        
        <div class="col-md-12">
            <?php if(isset($this->userId) && $this->userId!=$model->owner_id){ ?>
                <?php if(in_array($model->status, array(Yii::app()->params['lotteryStatusConst']['open'],Yii::app()->params['lotteryStatusConst']['active']))){ ?>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#buy-modal">
                        <?php echo Yii::t('wonlot','Compra biglietto'); ?>
                    </button>
                <?php } else { ?>
                    <p>Non puoi comprare...la lotteria non è aperta...</p>
                <?php } ?>
            <?php } elseif(isset($this->userId) && $this->userId==$model->owner_id) { ?>
                    <button type="button" class="btn btn-primary"><?php echo CHtml::link('Edit', CController::createUrl('lotteries/update/'.$model->id));?></button>
            <?php } ?>
        </div>
    </div>
</div>
<?php if(isset($this->userId) && $this->userId!=$model->owner_id){ ?>
    <?php $this->renderPartial('_buyModal',array('data'=>$model, 'addData' => $addData)); ?>
    <?php $this->renderPartial('_giftModal',array('data'=>$model)); ?>
<?php } ?>