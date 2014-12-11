<?php
/* @var $this AuctionsController */
/* @var $model Auctions */
?>

<div class="lot-panel panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo CHtml::encode($model->name); ?></h3>
    </div>
    <div class="panel-body">
        <?php if(!empty($model->id)){ ?>
            <?php $this->renderPartial('_galleryImage',array('model'=>$model)); ?>
        <?php } ?>
        <?php if($model->owner_id == $this->userId && $model->status == Yii::app()->params['lotteryStatusConst']['extracted']){ ?>
            <div class="col-md-12">
                <h3><?php echo Yii::t("wonlot","Richiedi pagamento"); ?></h3>
                <div class="text-block">
                    <?php $this->widget(payLotteryInfoWidget,array('model'=>$model,'returnUrl'=>Yii::app()->request->url, 'type'=>'lottery')); ?>
                </div>
            </div>
        <?php } ?>
        <?php if($model->winner_id == $this->userId){ ?>
            <div class="col-md-12">
                <h3><?php echo Yii::t("wonlot","Hai vinto"); ?></h3>
                <div class="text-block">
                    
                </div>
            </div>
        <?php } ?>
        <?php if(in_array($model->status,array(Yii::app()->params['lotteryStatusConst']['draft'],Yii::app()->params['lotteryStatusConst']['upcoming'],Yii::app()->params['lotteryStatusConst']['open']))){ ?>
            <div class="col-md-12">
                <h3><?php echo Yii::t("wonlot","Descrizione"); ?></h3>
                <div class="text-block">
                    <?php echo $model->prize_desc; ?>
                </div>
            </div>
<!--            <div class="col-md-6">
                <h3><?php echo Yii::t("wonlot","Video"); ?></h3>
                <div class="text-block">
                    <div id="widget"></div>
                    <div id="player"></div>
                    <script>
                        // 2. Asynchronously load the Upload Widget and Player API code.
                        var tag = document.createElement('script');
                        tag.src = "https://www.youtube.com/iframe_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                        // 3. Define global variables for the widget and the player.
                        //    The function loads the widget after the JavaScript code
                        //    has downloaded and defines event handlers for callback
                        //    notifications related to the widget.
                        var widget;
                        var player;
                        function onYouTubeIframeAPIReady() {
                          widget = new YT.UploadWidget('widget', {
                            width: 450,
                            webcamOnly: false,
                            events: {
                              'onUploadSuccess': onUploadSuccess,
                              'onProcessingComplete': onProcessingComplete
                            }
                          });
                        }

                        // 4. This function is called when a video has been successfully uploaded.
                        function onUploadSuccess(event) {
                            alert(1);
                          alert('Video ID ' + event.data.videoId + ' was uploaded and is currently being processed.');
                        }

                        // 5. This function is called when a video has been successfully
                        //    processed.
                        function onProcessingComplete(event) {
                            alert(2);
                          /*player = new YT.Player('player', {
                            height: 390,
                            width: 640,
                            videoId: event.data.videoId,
                            events: {}
                          });*/
                        }
                      </script>
                </div>
            </div>-->
        <?php } else { ?>
            <div class="col-md-12">
                <h3><?php echo Yii::t("wonlot","Descrizione"); ?></h3>
                <div class="text-block">
                    <?php echo $model->prize_desc; ?>
                </div>
            </div>
        <?php } ?>
        <div class="col-md-4">
            <h4><?php echo Yii::t("wonlot","Informazioni"); ?></h4>
            <div class="text-block">
                <p><?php echo Yii::t("wonlot","Utente:"); ?> <a href="<?php echo CController::createUrl('/users/view/'.$model->owner_id);?>"><span class="lot-b-text"><?php echo CHtml::encode($model->owner->username); ?></span><?php echo Users::model()->getImageTag($model->owner,'smallSquaredThumb'); ?></a></p>
                <p><?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->getStatusText()); ?></span></p>
                <p><?php echo Yii::t("wonlot","Categoria:"); ?> 
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
                <p><?php echo Yii::t("wonlot","Ticket:"); ?> 
                    <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                    <span class="lot-prize-text">
                        <?php echo CHtml::encode($model->ticket_value); ?>
                    </span>
                </p>
                <p><?php echo Yii::t("wonlot","Città:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($model->location->address); ?></span></p>
                <p><?php echo Yii::t("wonlot","Stato del premio:"); ?> 
                    <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['prizeConditionsId'][$model->prize_conditions]); ?></span><br/>
                    <span class="lot-i-text"><?php echo CHtml::encode($model->prize_condition_text); ?></span>
                </p>
                <p><?php echo Yii::t("wonlot","Consegna:"); ?> <span class="lot-b-text"><?php echo CHtml::encode(Yii::app()->params['speditionTypeId'][$model->prize_shipping]); ?></span></p>
            </div>
        </div>
        <?php if($model->owner->id == $this->userId){ ?>
            <div class="col-md-4">
                <h4><?php echo Yii::t("wonlot","Info per il venditore"); ?></h4>
                <div class="text-block">
                    <p>
                        <?php echo Yii::t("wonlot","Incasso attuale:"); ?>
                        <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                        <span class="lot-b-text"><?php echo CHtml::encode($model->ticket_sold_value); ?></span>
                    </p>
                    <div class="box-panel-win panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo Yii::t('wonlot','Attualmente in testa'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt><?php echo Yii::t('wonlot','Utente'); ?></dt>
                                <dd>
                                    <span class="user-small-avatar-container">
                                        <a href="<?php echo CController::createUrl('users/view/'.$model->winningUser->id);?>">
                                            <?php echo Users::model()->getImageTag($model->winningUser); ?>
                                            <span class="small-username"><?php echo CHtml::encode($model->winningUser->username); ?></span>
                                        </a>
                                    </span>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt><?php echo Yii::t('wonlot','Punteggio'); ?></dt>
                                <dd><b><?php echo $model->winning_sum; ?></b></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4><?php echo Yii::t("wonlot","Condividi sul tuo sito!"); ?></h4>
                <div class="text-block">
                    <?php $btnCode = CHtml::link(CHtml::image(Yii::app()->controller->createAbsoluteUrl('/').'/images/site/icon-wl-buy.png', 'Compra con WonLot'), Yii::app()->controller->createAbsoluteUrl('auctions/view/'.$model->id));?>
                    <?php // $btnCode = '<a href="'.Yii::app()->controller->createAbsoluteUrl('auctions/view/'.$model->id).'"><img src="'.Yii::app()->controller->createAbsoluteUrl('/').'images/site/icon-wl-buy.png" alt="Compra con WonLot"></a>';?>
                    <?php echo CHtml::hiddenField('lot-txt-copy',$btnCode);?>
                    <blockquote>
                        <?php echo CHtml::link(CHtml::image('/images/site/icon-wl-buy.png', 'Compra con WonLot'), Yii::app()->controller->createAbsoluteUrl('auctions/view/'.$model->id));?>
                        <button class="btn btn-sm btn-default lot-btn-copy"><?php echo Yii::t('wonlot','Copia negli appunti'); ?></button>
                        <footer><?php echo Yii::t('wonlot','Copia il codice negli appunti ed usalo per creare un collegamento con la tua Asta sul tuo sito!'); ?></footer>
                    </blockquote>
                </div>
            </div>
        <?php } ?>
        <?php $this->widget('shareWidget',array('model'=>$model)); ?>
        
        <div class="col-md-4">
            <div class="box-panel-win panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo Yii::t('wonlot','Attualmente in testa'); ?></h3>
                </div>
                <div class="panel-body winner-panel winningBox">
                    <dl class="dl-horizontal">
                        <dt><?php echo Yii::t('wonlot','Utente'); ?></dt>
                        <dd>
                            <span class="user-small-avatar-container winningUser">
                                <input class="winningUserHidden" type="hidden" value="<?php echo $model->winningUser->id; ?>">
                                <a href="<?php echo CController::createUrl('users/view/'.$model->winningUser->id);?>">
                                    <?php echo Users::model()->getImageTag($model->winningUser); ?>
                                    <span class="small-username"><?php echo CHtml::encode($model->winningUser->username); ?></span>
                                </a>
                            </span>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <input class="winningValHidden" type="hidden" value="<?php echo $model->winning_sum; ?>">
                        <dt><?php echo Yii::t('wonlot','Punteggio'); ?></dt>
                        <dd><b class="winningVal"><?php echo $model->winning_sum; ?></b></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel-body">
                <?php if(isset($this->userId) && $this->userId!=$model->owner_id){ ?>
                    <?php if(in_array($model->status, array(Yii::app()->params['lotteryStatusConst']['open'],Yii::app()->params['lotteryStatusConst']['active']))){ ?>
                        <!--<button class="btn btn-primary btn-lg" id="openBuyModal" data-toggle="modal" data-target="#buy-modal" onclick="js:$.updateLotteryModal('buy',<?php echo $model->id; ?>);">-->
                        <button class="btn btn-primary btn-lg" id="openBuyModal" data-toggle="modal" data-target="#buy-modal">
                            <em class="glyphicon glyphicon-ok"><?php echo Yii::t('wonlot','Compra biglietto'); ?></em>
                        </button>
                        <!--<button class="btn btn-primary btn-lg" id="openGiftModal" data-toggle="modal" data-target="#gift-modal"  onclick="js:$.updateLotteryModal('gift',<?php echo $model->id; ?>);">-->
                        <button class="btn btn-primary btn-lg" id="openGiftModal" data-toggle="modal" data-target="#gift-modal">
                            <em class="glyphicon glyphicon-gift"><?php echo Yii::t('wonlot','Regala biglietto'); ?></em>
                        </button>
                    <?php } else { ?>
                        <p>L' Asta non è aperta, non è possibile acquistare biglietti</p>
                    <?php } ?>
                <?php } elseif(isset($this->userId) && $this->userId==$model->owner_id) { ?>
                    <?php if(in_array($model->status, array(Yii::app()->params['lotteryStatusConst']['draft'],Yii::app()->params['lotteryStatusConst']['upcoming'],Yii::app()->params['lotteryStatusConst']['open']))){ ?>
                        <?php echo CHtml::link('Modifica', CController::createUrl('auctions/update/'.$model->id),array('class'=>'btn btn-primary'));?>
                        <?php echo CHtml::link('Annulla Asta', Yii::app()->createUrl("auctions/void", array("id"=>$model->id)),array('class'=>'btn btn-danger'));?>
                        <?php echo CHtml::link('Torna alle tue aste', Yii::app()->createUrl("auctions/userIndex"),array('class'=>'btn btn-default'));?>
                    <?php } ?>
                    <?php if($this->lotErrors['update']){ ?>
                        <div class="alert alert-danger">
                            <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                            <?php echo CHtml::encode($this->lotErrors['update']); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if(isset($this->userId) && $this->userId!=$model->owner_id){ ?>
    <?php $this->renderPartial('_buyModal',array('data'=>$model, 'addData' => $addData)); ?>
    <?php $this->renderPartial('_giftModal',array('data'=>$model, 'addData' => $addData)); ?>
<?php } ?>
<script>
    $(window).load(function(){
        $.updateAuctionModal(<?php echo $model->id; ?>);
    });
</script>