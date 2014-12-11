<div class="modal fade" id="buy-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php $checkBuy = $this->userCanBuy($data->id); ?>  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('wonlot','Compra Ticket'); ?></h4>
      </div>
      <div class="modal-body">
            <?php if($checkBuy === true){ ?>                    
                <div class="center-float">
                    <?php 
                        $addData = array('version' => 'complete', 'data' => $data);
                        $this->renderPartial('_buyAjax', $addData); 
                        ?>
                </div>
                    
            <?php } elseif($checkBuy == Auctions::errorGuest) { ?>
                <h4><?php echo Yii::t('wonlot','Entra o registrati per comprare'); ?></h4>
                <?php $this->renderPartial('/site/login',array('showLogin'=>true)); ?>
            <?php } elseif($checkBuy == Auctions::errorStatus) { ?>
                <h4><?php echo Yii::t('wonlot','Asta in stato errato'); ?></h4>
            <?php } elseif($checkBuy == Auctions::errorCredit) { ?>
                <h4><?php echo Yii::t('wonlot','Credito non sufficente'); ?></h4>
                <div>
                    <?php echo Yii::t('wonlot','Vai al Tuo Profilo per ricaricare'); ?>
                    <?php echo CHtml::link(Yii::t('wonlot','Profilo'), array('users/myProfile#tabProfile2'), array('class'=>'btn btn-primary')); ?>
                </div>
            <?php } elseif($checkBuy == Auctions::errorOwner) { ?>
                <h4><?php echo Yii::t('wonlot','Non puoi comprare la tua lotteria'); ?></h4>
            <?php } ?>
      </div>
      <div class="modal-footer">
          <?php echo CHtml::ajaxButton ("Compra!",
            CController::createUrl('auctions/buyTicket'), 
            array(
              'update' => '#buy-main',
              'type' => 'POST', 
              'data'=>'js:$("#buyLotteryForm").serialize()',
            ),
            array('name'=>'buyBtn', 'class'=>'btn btn-primary', 'disabled'=>($checkBuy ? '' : 'disabled'))
            ); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
      </div>
    </div>
  </div>
</div>