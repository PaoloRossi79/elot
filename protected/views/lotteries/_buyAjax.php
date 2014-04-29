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
    <!--            <table cellspacing="0" border="0" class="event-recap-table compact table table-condensed">
                    <?php foreach ($this->ticketTotals as $ti){ ?>
                    <tr>
                       <td class="ert-label"><?php echo $ti->serial_number; ?></td>
                       <td class="ert-label">
                       <?php if($ti->is_gift == 1){ ?>
                           <p><span class="bg-success">Regalato!</span></p>
                       <?php } else { ?>
                           <button id="<?php echo $ti->id; ?>" class="btn btn-success btn-xs set-gift"><i class="glyphicon glyphicon-search">Regala</i></button> 
                       <?php } ?>
                       </td>
                    </tr>
                    <?php } ?>
                </table>       -->
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
        <?php if(count($this->giftTicketTotals) > 0){ ?>
            
            <div class="modal-gallery-subtitle no-margin">Hai ricevuto in regalo <b><?php echo count($this->giftTicketTotals); ?></b> ticket!</div>
            <div class="giftTicketGrid">
                <!-- NEW STYLE: come ticket con bottone sotto! -->
                <?php foreach ($this->giftTicketTotals as $t){ ?>
                    <div class="ticket-lot" id="ticket-lot-"<?php echo $t->id; ?>>
                        <?php if($m->winner_ticket_id == $t->id){ ?>
                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/winner.png", "Winner", array("class"=>"winner-ban")); ?>
                        <?php } ?>
                        <?php echo CHtml::link($t->serial_number, CController::createUrl('tickets/view/'.$t->id), array('class'=> 'ticket-number-text')); ?>
                            <span class="ticket-gift-text bg-success">In regalo!</span>
                    </div>
                <?php } ?>
            </div>
            <script>
                $(".giftTicketGrid").slimScroll({
                     height: '300px',
                     size: '5px',
                }); 
            </script>
        <?php } ?>
    </div>
</div>
<script>
   /*$('.set-gift').click(function(event) {
        $("#BuyForm_ticketGiftId").val($(this).attr("id"));
        $(".gift-box").slideDown(); 
//                $("#labelTicketNumber").text($(this).parent().parent().children().first().text()); 
        $("#labelTicketNumber").text($(this).parent().children().first().text()); 
        $('#buy-modal').modal('hide');
        $('#gift-modal').modal('show');
        $('#gift-email-form').get(0).reset();
        $("#emailFormGroup").removeClass("has-error");
        $("#emailFormGroup").removeClass("has-success");
        $("#emailSuccessText").hide();
        $("#emailErrorText").hide();
        $("#giftBtn").removeAttr("disabled");
        return false;
   });*/
</script>
