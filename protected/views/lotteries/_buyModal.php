<div class="modal fade" id="buy-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Compra Ticket</h4>
      </div>
      <div class="modal-body">
            <?php 
                $checkBuy = $this->userCanBuy($data->id);
                if($checkBuy === true){ 
            ?>                    
                    <div class="row">
                    <?php echo CHtml::ajaxButton ("Compra!",
                        CController::createUrl('lotteries/buyTicket'), 
                        array(
                          'update' => '#data-'.$data->id,
                          'type' => 'POST', 
                          'data'=>'js:$("#buyLotteryForm").serialize()',
                          /*'beforeSend'=>'function(){'
                            . '$(".gift-box").slideUp(); '
                            . '$("#ticketGrid").slideDown(); '
                            . '}',*/
                        ),
                        array('name'=>'buyBtn', 'class'=>'btn btn-primary buy-btn')
                        ); ?>
                        <div id="alert-box" class="alert alert-error" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong id="alert-strong"></strong><span id="alert-msg"></span>
                        </div>
                        <p style="display: none;" class="cannot-buy">Mi spiace...non puoi più comprare ticket per questa lotteria!</p>
                    </div>
                    <div class="row center-float">
                        <div class="">
                        <?php 
                            $addData = array('version' => 'complete', 'data' => $data);
                            $this->renderPartial('_buyAjax', $addData); 
                            ?>
                        </div>
                    </div>
                    
            <?php } elseif($checkBuy == Lotteries::errorGuest) { ?>
                <h4>LOGIN TO BUY!</h4>
                <?php $this->renderPartial('/site/login',array('showLogin'=>true)); ?>
            <?php } elseif($checkBuy == Lotteries::errorStatus) { ?>
                <h4>LOTTERY IN WRONG STATUS</h4>
            <?php } elseif($checkBuy == Lotteries::errorCredit) { ?>
                <h4>NOT ENOUGH CREDIT!</h4>
            <?php } elseif($checkBuy == Lotteries::errorOwner) { ?>
                <h4>CANNOT BUY YOUR LOTTERY!</h4>
            <?php } ?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>