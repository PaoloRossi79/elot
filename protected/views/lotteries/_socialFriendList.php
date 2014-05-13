<div class="form" id="social-friend-list">
    <div id="followingFormGroup" class="form-group">
      <p class="giftErrorText text-danger"><?php echo Yii::t('wonlot','Errore di invio regalo'); ?></p>
      <p class="giftSuccessText text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>        
      <?php echo CHtml::hiddenField('gift-userid',null, array('name'=>'gift-userid')); ?>
      <?php echo CHtml::hiddenField('gift-provider',null, array('name'=>'gift-userid')); ?>
      <button class="btn btn-primary feedShare">
        <?php echo Yii::t('wonlot','Regala'); ?>
      </button>
      <p> il ticket a: <span><?php echo CHtml::textField('gift-username',null, array('name'=>'gift-username','readonly'=>'readonly')); ?></span></p>
    </div>
        <div class="friends-container">
            <h4><?php echo Yii::t('wonlot','Amici su: '); ?><span class='labelProvider'></span></h4>
            <div id="social-friend-box"></div>
        </div>
    <button id="gpshare-gift" class="button white medium hidden"></button>
</div>
<script type="text/html" id="fb-template">
    <div class="user-small-ticket-box">
        <input type="hidden" name="id" data-value="id">
        <input type="hidden" name="username" data-value="name">
        <span class="user-small-avatar-container">           
            <img data-src="id" data-format="FbImageFormatter" data-format-target="src" class="img-thumbnail user-small-thumb" alt="User Avatar">
        </span>
        <span class="user-small-vendor-container">
            <span class="small-username" data-content="name"></span>
        </span>
    </div>
</script>
<script type="text/html" id="gp-template">
    <div class="user-small-ticket-box">
        <input type="hidden" name="id" data-value="id">
        <input type="hidden" name="username" data-value="displayName">
        <span class="user-small-avatar-container">           
            <img data-src="image.url" class="img-thumbnail user-small-thumb" alt="User Avatar">
        </span>
        <span class="user-small-vendor-container">
            <span class="small-username" data-content="displayName"></span>
        </span>
    </div>
</script>