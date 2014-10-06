<div class="modal fade" id="buy-credit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <?php 
        $creditForm = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'userWallet-form',
                'action'=>CController::createUrl('users/buyCredit'),
                'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
            )
        );
    ?>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('wonlot','Compra Credito'); ?></h4>
        </div>
        <div class="modal-body">

          <?php echo $creditForm->errorSummary($model); ?>
            <h4><?php echo Yii::t('wonlot','Scegli un importo'); ?></h4>
            <?php 
            $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
            echo $creditForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
            ?>
            <br/>
            <?php //echo $creditForm->CMaskedTextField($model, 'creditOption', array('class' => 'span3','size'=>45,'maxlength'=>45)); ?>
            <div>
                <p><?php echo Yii::t('wonlot','Altro importo'); ?></p>
                <?php echo $creditForm->textField($model, 'creditValue', array('class' => 'span3','size'=>10,'maxlength'=>10)); ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php echo CHtml::submitButton(Yii::t('wonlot','Acquista credito'),array('class'=>'btn btn-success')); ?>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('wonlot','Chiudi'); ?></button>
        </div>
      </div>
    </div>
    <?php $this->endWidget(); ?>     
</div>