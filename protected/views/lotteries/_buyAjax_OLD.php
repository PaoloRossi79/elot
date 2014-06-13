<div id="data-<?php echo $data->id; ?>">
    <div class="ticket-list">
        <?php 
        if(!is_null($result)){
          if(!$canBuyAgain){
              $cs = Yii::app()->clientScript;
              $cs->registerScript('blockBuy', '$("input[name=buyBtn]").attr("disabled", "disabled").fadeOut();$(".cannot-buy").fadeIn()', CClientScript::POS_READY);
          } 
          if($result == "OK!"){
              ?>
                <script>
                    $('#alert-box').removeClass('alert-error');
                    $('#alert-box').addClass('alert-success');
                    $('#alert-box').fadeIn();
                </script>
              <?php
          } else {
              ?>
                <script>
                    $('#alert-box').removeClass('alert-success');
                    $('#alert-box').addClass('alert-error');
                    $('#alert-box').fadeIn();
                </script>
              <?php
          }
          ?>
            <script>
                $('#alert-strong').text("<?php echo $result; ?>");
                $('#alert-msg').text("<?php echo $msg; ?>");
            </script>
          <?php
        }
        $dataId=0;
        $lot=null;
        if(isset($data->id)){
            $dataId=$data->id;
        } else {
            $dataId=$id;
        }
        ?>
        <?php /** @var TbActiveForm $form */
        $formModel = new BuyForm;
        $formModel->lotId = $dataId;
        $formModel->ticketGiftId = null;
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'buyLotteryForm',
            )
        ); 
        echo $form->hiddenField($formModel,'lotId'); 
        echo $form->hiddenField($formModel,'ticketGiftId'); 
        ?>
        <?php 
                $formModel->offerId = -1;
                $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
                if(!empty($offersType)){
                    echo $form->labelEx($formModel,'offerId');
                    echo $form->dropDownList($formModel,'offerId',$offersType,array('empty'=>Yii::t("wonlot",'Nessuna offerta')));
                }
            ?>

        <?php $this->endWidget(); ?>
        <?php if(true){ ?>
            <div class="modal-gallery-subtitle no-margin">Hai già comprato <b><?php echo count($this->ticketTotals); ?></b> ticket!</div>
            <div class="ticketGrid">
                <!-- NEW STYLE: come ticket con bottone sotto! -->
                <?php $this->widget('ticketsWidget',array('tickets'=>$this->ticketTotals)); ?>
            </div>
            <script>
                $(".ticketGrid").slimScroll({
                     height: '300px',
                     size: '5px',
                }); 
            </script>
        <?php } ?>
    </div>
</div>