<div class="modal fade" id="with-credit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('wonlot','Ritira Credito'); ?></h4>
      </div>
      <div class="modal-body">
          <div id="bill-modal-form">
              <?php $this->renderPartial('_billForm',array('model'=>$model));?>
          </div>
          <?php echo CHtml::ajaxButton ("Salva dati",
            CController::createUrl('users/savePayInfo'), 
            array('update' => '#bill-modal-form',
                    'type' => 'POST', 
                    'data'=>'js:$("#userPaymentInfoReq-form").serialize()',
            ),array('class'=>'btn btn-success')); ?>
          <div id="with-modal-form">
              <?php $this->renderPartial('_withCreditForm',array('model'=>$model));?>
          </div>
          <?php echo CHtml::ajaxButton ("Ritira denaro",
            CController::createUrl('users/requestWithdraw'), 
            array('update' => '#with-modal-form',
                    'type' => 'POST', 
                    'data'=>'js:$("#userWithdrawReq-form").serialize()',
            ),array('class'=>'btn btn-success')); ?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
      </div>
    </div>
  </div>
</div>