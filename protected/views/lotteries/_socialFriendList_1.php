<div class="form" id="social-friend-list">
    <div id="followingFormGroup" class="form-group">
      <p class="giftErrorText text-danger"><?php echo Yii::t('wonlot','Errore di invio regalo'); ?></p>
      <p class="giftSuccessText text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>        
      <?php echo CHtml::hiddenField('gift-userid',null, array()); ?>
      <button class="btn btn-primary feedShare" id='<?php echo $f->identifier; ?>' data-provider="<?php echo $provider; ?>">
        <?php echo Yii::t('wonlot','Regala'); ?>
      </button>
      <p> il ticket a: <span><?php echo CHtml::textField('gift-username',null, array('readonly'=>'readonly')); ?></span></p>
    </div>
    <?php if($provider) { ?>
        <script>
            $('.gift-ticket-box').filter('[name=0]').fadeIn();       
        </script>
    <?php } ?>
    <?php if($list) { ?>
        <script>
            $('.box-spinner').hide();
        </script>
        <div class="friends-container">
            <h4><?php echo Yii::t('wonlot','Amici su: ').$provider; ?></h4>
            <?php foreach ($list as $f) { ?>
            <div class="user-small-ticket-box">
                <input type="hidden" name="id" value="<?php echo $f->identifier; ?>">
                <input type="hidden" name="username" value="<?php echo $f->displayName; ?>">
                <span class="user-small-avatar-container">                        
                    <?php echo CHtml::image($f->photoURL, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                </span>
                <span class="user-small-vendor-container">
                    <span class="small-username"><?php echo CHtml::encode($f->displayName); ?></span>
                </span>
            </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>Nessun amico trovato!</p>
    <?php } ?>
  </div>
<script type="text/html" id="template">
    <div data-content="author"></div>
    <div data-content="date"></div>
    <img data-src="authorPicture" data-alt="author"/>
    <div data-content="post"></div>
</script>