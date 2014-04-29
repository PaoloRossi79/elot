<?php
/* @var $this TicketsController */
/* @var $model Tickets */
?>

<h1>View Ticket #<?php echo $model->serial_number; ?></h1>

<div class="lot-panel panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo CHtml::encode($model->lottery->name); ?></h3>
    </div>
    <div class="panel-body">
        <?php
            if($model->lottery->winner_ticket_id == $model->id){ ?>
                <div class="col-md-12">
                    <h3><?php echo Yii::t("wonlot","Hai vinto!"); ?></h3>
                    <div class="text-block">
                        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/winner.png", "Winner", array("class"=>"winner-ban")); ?>
                    </div>
                </div>
        <?php } ?>
        <?php if($model->is_gift){ ?>
            <?php $userId = Yii::app()->user->id; ?>
                <div class="col-md-12">
                    <h3><?php echo Yii::t("wonlot","Regalo!"); ?></h3>
                    <?php if($model->gift_from_id == $userId && $model->user_id == $userId) { ?>
                        <div class="text-block">
                            <?php echo Yii::t('wonlot','Ticket regalato a'); ?>&nbsp;
                            <b><?php echo $model->gift_ext_user; ?></b>&nbsp;
                            <?php echo Yii::t('wonlot','(in attesa di iscrizione)'); ?>
                        </div>
                    <?php } elseif($model->gift_from_id == $userId){ ?>
                        <div class="text-block">
                            <?php echo Yii::t('wonlot','Ticket regalato a '); ?>
                            <b><?php echo $model->giftFromUser->username; ?></b>
                        </div>
                    <?php } elseif($model->gift_from_id != $userId && $model->user_id == $userId) { ?>
                        <div class="text-block">
                            <?php echo Yii::t('wonlot','Ticket regalato da'); ?>&nbsp;
                            <b><?php echo $model->giftFromUser->username; ?></b>
                        </div>
                    <?php } ?>
                </div>
        <?php } ?>
        <?php
            $imgList=Lotteries::model()->getImageList($model->lottery->id);
            if(!empty($imgList)){ ?>
                <div class="col-md-12">
                    <h3><?php echo Yii::t("wonlot","Immagini"); ?></h3>
                    <div class="text-block">
                        <?php foreach($imgList as $k=>$img){ ?>
                                <?php echo CHtml::image($this->getImageUrl($img,"smallSquaredThumb"),'Prize image '.$k,array('class'=>'img-thumbnail')); ?>
                        <?php } ?>
                    </div>
                </div>
        <?php } ?>
        <div class="col-md-12">
            <h3><?php echo Yii::t("wonlot","Descrizione"); ?></h3>
            <div class="text-block">
                <?php echo $model->lottery->prize_desc; ?>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Informazioni"); ?></h4>
            <div class="text-block">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t("wonlot","Stato:"); ?></dt>
                    <dd><span class="lot-b-text"><?php echo CHtml::encode($model->lottery->getStatusText()); ?></span></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t("wonlot","Categoria:"); ?></dt>
                    <dd><?php echo CHtml::image('/images/site/'.$model->lottery->category->image, $model->lottery->category->category_name,array('class'=>'cat-icon'));?> 
                    <span class="lot-b-text">
                        <?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($model->lottery->prize_category)); ?>
                    </span></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t("wonlot","Data di apertura:"); ?></dt>
                    <dd><span class="lot-b-text"><?php echo CHtml::encode($model->lottery->lottery_start_date); ?></span></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t("wonlot","Data di estrazione:"); ?></dt>
                    <dd><span class="lot-b-text"><?php echo CHtml::encode($model->lottery->lottery_draw_date); ?></span></dd>
                </dl>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Premio"); ?></h4>
            <div class="text-block">
                <p><?php echo Yii::t("wonlot","Città:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->lottery->location->address); ?></span></p>
                <p><?php echo Yii::t("wonlot","Stato:"); ?> 
                    <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['prizeConditionsId'][$model->lottery->prize_conditions]); ?></span><br/>
                    <span class="lot-i-text"><?php echo CHtml::encode($model->lottery->prize_condition_text); ?></span>
                </p>
                <p><?php echo Yii::t("wonlot","Consegna:"); ?> <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['speditionTypeId'][$model->lottery->prize_shipping]); ?></span></p>
            </div>
        </div>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Ticket"); ?></h4>
            <div class="text-block">
                <p>
                    <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                    <span class="lot-prize-text">
                        <?php echo CHtml::encode($model->lottery->ticket_value); ?>
                    </span>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if($model->lottery->owner->id == $this->userId){ ?>
            <div class="col-md-4">
                <h4><?php echo Yii::t("wonlot","Info per il venditore"); ?></h4>
                <div class="text-block">
                    <?php if($model->lottery->prize_price){ ?>
                        <p>
                            <?php echo Yii::t("wonlot","Valore premio:"); ?>
                            <span class="lot-b-text"><?php echo CHtml::encode($model->lottery->prize_price); ?></span>
                        </p>
                        <p>
                            BARRA PROGRESSO!
                        </p>
                    <?php } ?>
                    <p>
                        <?php echo Yii::t("wonlot","Incasso attuale:"); ?>
                        <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                        <span class="lot-b-text"><?php echo CHtml::encode($model->lottery->ticket_sold_value); ?></span>
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
    </div>
</div>