<div class="modal fade" id="acceptModal" data-show="true" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Accept policy" aria-hidden="true">
    <div class="modal-dialog" id='acceptModalContent'>
      <div class="modal-content">
        <div class="modal-header">
          <?php Yii::app()->request->cookies['activation-request'] = new CHttpCookie('activation-request', 1); ?>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('wonlot','Accetta condizioni e regolamento'); ?></h4>
        </div>
        <div class="modal-body" id="accept-form">
            <?php $this->renderPartial('/site/acceptPolicyForm',array('model'=>$model)); ?>
            
        </div>
        <div class="modal-footer">
            <div class="row buttons">
                <div class="form-group">
                    <?php echo CHtml::ajaxButton ("Accetta",
                    CController::createUrl('users/acceptPolicy'), 
                    array(
                      'update' => '#accept-form',
                      'type' => 'POST', 
                      'data'=>'js:$("#user_accept_form").serialize()',
                    ),
                    array('name'=>'acceptPolicyBtn', 'class'=>'btn btn-primary')
                    ); ?>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
