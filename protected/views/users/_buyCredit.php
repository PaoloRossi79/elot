<div class="modal fade" id="buy-credit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
                <?php echo Yii::t('wonlot','Compra Credito'); ?>
                <?php $this->renderPartial('/users/availableCreditTitle',array('model'=>$model)); ?>
          </h4>
        </div>
        <div class="modal-body">
            <div id="buy-modal-form">
                <?php $this->renderPartial('_buyCreditForm',array('model'=>$model));?>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo CHtml::ajaxButton ("Acquista credito",
                CController::createUrl('users/buyCredit'), 
                array('update' => '#buy-modal-form',
                        'type' => 'POST', 
                        'data'=>'js:$("#userWallet-form").serialize()',
                ),array('class'=>'btn btn-success','id'=>'okConfirmBuyCreditButton')); ?>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
        </div>
      </div>
    </div>
    
</div>