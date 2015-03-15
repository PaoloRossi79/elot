<span class="pull-right">
    <small><?php echo Yii::t('elot','Credito disponibile:'); ?></small>
      <span>
          <?php echo CHtml::encode($model->available_balance_amount); ?>
          <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
      </span>
    <span class="spacer">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </span>
</span>