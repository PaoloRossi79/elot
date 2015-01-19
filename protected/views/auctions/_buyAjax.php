<div id="buy-main">
    <div class="ticket-list" class="container-fluid">
        <?php 
        if(!is_null($result)){
          $ticketBoxSize = 500;
          if(!$canBuyAgain){
              $cs = Yii::app()->clientScript;
              $cs->registerScript('blockBuy', 
                '$("input[name=buyBtn]").attr("disabled", "disabled").fadeOut();
                 $(".cannot-buy").fadeIn()'
              , CClientScript::POS_READY);
          } ?>
        
          <?php
          if($result == "1"){
              ?>
                <script>
                    $('#ok-msg').text("<?php echo $msg; ?>");
                    $('.box-panel-ok').fadeIn();
                </script>
              <?php
          } else {
              ?>
                <script>
                    $('#alert-msg').text("<?php echo $msg; ?>");
                    $('.box-panel-err').fadeIn();
                </script>
              <?php
          }
        ?>
        <?php
            $ticketBoxSize = 350;
        }
        if(isset($winRes)){
            if($winRes['isWinning'] && !$winRes['newWinner']){ ?>
                <script>
                    $('#win-strong').text("Sei già in testa!");
                    $('#win-msg').text("Sei già in testa con "+<?php echo $winRes['actWinnerValue']; ?>);
                    $('#alert-box').fadeIn();
                </script>
            <?php } elseif($winRes['isWinning'] && $winRes['newWinnerUser']){ ?>
                <script>
                    $('#win-strong').text("Sei passato in testa");
                    $('#win-msg').text("Sei passato in testa con "+<?php echo $winRes['newWinnerValue']; ?>);
                    $('#alert-box').fadeIn();
                </script>
            <?php } 
        }
        ?>
        <?php /** @var TbActiveForm $form */
        $formModel = new BuyForm;
        $formModel->lotId = $data->id;
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'buyLotteryForm',
            )
        ); 
        echo $form->hiddenField($formModel,'lotId'); 
        ?>
        
        <div class="buy-box container-fluid">
            <div class="col-md-6">
                <div class="box-panel-score panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Il tuo punteggio'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo Yii::t('wonlot','WTICKETS acquistati'); ?></dt>
                            <dd><b><?php echo count($this->ticketTotals); ?></b></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt><?php echo Yii::t('wonlot','WCREDITS totali'); ?></dt>
                            <dd><b><?php echo $this->actualWeight; ?></b></dd>
                        </dl>
                    </div>
                </div>
                <div class="box-panel-win panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Attualmente in testa'); ?></h3>
                    </div>
                    <div class="panel-body winningBox">
                        <dl class="dl-horizontal">
                            <dt><?php echo Yii::t('wonlot','Utente'); ?></dt>
                            <dd>
                                <span class="user-small-avatar-container winningUser">
                                    <input class="winningUserHidden" type="hidden" value="<?php echo $data->winningUser->id; ?>">
                                    <a href="<?php echo CController::createUrl('users/view/'.$data->winningUser->id);?>">
                                        <?php echo Users::model()->getImageTag($data->winningUser); ?>
                                        <span class="small-username"><?php echo CHtml::encode($data->winningUser->username); ?></span>
                                    </a>
                                </span>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <input class="winningValHidden" type="hidden" value="<?php echo $data->winning_sum; ?>">
                            <dt><?php echo Yii::t('wonlot','WCREDITS totali'); ?></dt>
                            <dd><b class="winningVal"><?php echo $data->winning_sum; ?></b></dd>
                        </dl>
                    </div>
                </div>
                <div class="box-panel-ok panel panel-success" style="display: none;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Acquistato!'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="ok-box" class="alert alert-success">
                            <strong id="win-strong"></strong><span id="ok-msg"></span>
                        </div>
                        <p style="display: none;" class="cannot-buy">Mi spiace...non puoi più comprare ticket per questa Asta!</p>
                    </div>
                </div>
                <div class="box-panel-err panel panel-danger" style="display: none;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Errore'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="alert-box" class="alert alert-error">
                            <strong id="alert-strong"></strong><span id="alert-msg"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ticket-box col-md-6">
                <div class="ticketGrid">
                    <!-- NEW STYLE: come ticket con bottone sotto! -->
                    <?php $this->widget('ticketsWidget',array('tickets'=>$this->ticketTotals)); ?>
                </div>
                
                <script>
                    $(".ticketGrid").slimScroll({
                         height: '<?php echo $ticketBoxSize; ?>px',
                         size: '5px',
                    }); 
                </script>
            </div>
        </div>
        <div class="special-offer-block form-group">
        <?php 
            $formModel->offerId = -1;
            $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
            if(!empty($offersType)){ ?>
                <div class="col-md-5">
                    <?php echo $form->labelEx($formModel,'offerId'); ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    if($offerId){
                        echo $form->dropDownList($formModel,'offerId',$offersType,array('options' => array($offerId=>array('selected'=>true)),'empty'=>Yii::t("wonlot",'Nessuna offerta'),'class'=>'form-control')); 
                    } else {
                        echo $form->dropDownList($formModel,'offerId',$offersType,array('empty'=>Yii::t("wonlot",'Nessuna offerta'),'class'=>'form-control')); 
                    }
                    ?>
                </div>
            <?php } ?>
        </div>

        <?php $this->endWidget(); ?>
        
    </div>
</div>