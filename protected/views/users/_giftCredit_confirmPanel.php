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
          <?php /*echo CHtml::ajaxButton ("Regala Credito",
            CController::createUrl('users/giftCredit'), 
            array('update' => '#gift-modal-form',
                    'type' => 'POST', 
                    'data'=>'js:$("#userCreditGift-form").serialize()',
                    'beforeSend'=>'js:function(){$.confirmGift();}'
            ),array('class'=>'btn btn-success','style'=>'display: none;','id'=>'okConfirmGiftCreditButton'));*/ ?>
          <!--<button id="openConfirmGiftCredit" type="button" class="btn btn-success"><?php echo Yii::t('wonlot','Regala Credito'); ?></button>-->
          <div id="buttonGiftCreditPanel">
              <button id="openConfirmGiftPanel" type="button" class="btn btn-success"><?php echo Yii::t('wonlot','Regala Credito'); ?></button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
          </div>
          <div class="startHide" id="confirmGiftCreditPanel">
                <p><?php echo Yii::t("wonlot","Sei sicuro di voler regalare il credito?"); ?></p>
                <p><em><?php echo Yii::t("wonlot","Il credito regalato non è rimborsabile"); ?></em></p>
                <?php echo CHtml::ajaxButton ("Regala Credito",
                CController::createUrl('users/giftCredit'), 
                array('update' => '#gift-modal-form',
                        'type' => 'POST', 
                        'data'=>'js:$("#userCreditGift-form").serialize()',
                ),array('class'=>'btn btn-success','id'=>'okConfirmGiftCreditButton')); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
          </div>
          <?php
            /*$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'giftDialog',
                'options'=>array(
                    'title'=>'Conferma regalo',
                    'autoOpen'=>false,
                    'modal'=>true,
                    'closeOnEscape'=>false,
                    'buttons'=>array(
                        'Ok'=>'js:function(){$.confirmGift()}',
                        'Annulla'=>'js:function(){$("giftDialog").dialog("close");}',
                    )
                ),
            ));*/
            ?>
            <!--<p><?php //echo Yii::t("wonlot","Sei sicuro di voler regalare il credito?"); ?></p>-->
            <!--<p><em><?php //echo Yii::t("wonlot","Il credito regalato non è rimborsabile"); ?></em></p>-->
            <?php
//            $this->endWidget('zii.widgets.jui.CJuiDialog');
            ?>

      </div>
    </div>
  </div>
</div>