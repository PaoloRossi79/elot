<div class="modal fade" id="gift-credit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">
            <?php echo Yii::t('wonlot','Regala Credito'); ?>
            <?php $this->renderPartial('/users/availableCreditTitle',array('model'=>$model)); ?>            
        </h4>
      </div>
      <div class="modal-body">
        <div id="gift-modal-form">
            <?php $this->renderPartial('_giftCreditForm',array('model'=>$model));?>
        </div>
      </div>
      <div class="modal-footer" id="giftCreditFooter">
          <div id="buttonGiftCreditPanel">
              <?php echo CHtml::ajaxButton ("Regala Credito",
                CController::createUrl('users/giftCredit'), 
                array('update' => '#gift-modal-form',
                        'type' => 'POST', 
                        'data'=>'js:$("#userCreditGift-form").serialize()',
                        'beforeSend'=>
                            'js:function(){
                                var res = confirm("Sei sicuro di voler regalare il credito? Il credito regalato non è rimborsabile");
                                if(res == true){
                                    return true;
                                } else {
                                    return false;
                                }
                                /*bootbox.confirm("Sei sicuro di voler regalare il credito? Il credito regalato non è rimborsabile", function(result) {
                                    if(result == true){
                                        return true;
                                    } else {
                                        return false;
                                    }
                                });*/
                            }'
                ),array('class'=>'btn btn-success','id'=>'okConfirmGiftCreditButton')); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
          </div>
          
      </div>
    </div>
  </div>
</div>