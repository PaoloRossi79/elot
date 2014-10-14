<div class="modal fade" id="gift-credit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('wonlot','Regala Credito'); ?></h4>
      </div>
      <div class="modal-body">
        <div id="gift-modal-form">
            <?php $this->renderPartial('_giftCreditForm',array('model'=>$model));?>
        </div>
      </div>
      <div class="modal-footer">
          <?php echo CHtml::ajaxButton ("Regala Credito",
            CController::createUrl('users/giftCredit'), 
            array('update' => '#gift-modal-form',
                    'type' => 'POST', 
                    'data'=>'js:$("#userCreditGift-form").serialize()',
            ),array('class'=>'btn btn-success')); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
      </div>
    </div>
  </div>
</div>