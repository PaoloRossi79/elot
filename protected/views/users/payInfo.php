<div class="container">
    <h1>Dati di fatturazione</h1>
    <div class="panel">
        <div class="panel-body">
            <div id="bill-modal-form">
              <?php $this->renderPartial('_billForm',array('model'=>null,'redirect'=>CController::createAbsoluteUrl('auctions/create')));?>
                </div>
                <?php echo CHtml::ajaxButton ("Salva dati",
                  CController::createUrl('users/savePayInfo'), 
                  array('update' => '#bill-modal-form',
                          'type' => 'POST', 
                          'data'=>'js:$("#userPaymentInfoReq-form").serialize()',
                  ),array('class'=>'btn btn-success')); ?>
        </div>    
    </div>    
</div>
