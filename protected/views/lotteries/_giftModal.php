<div class="modal fade" id="gift-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Regala Ticket</h4>
      </div>
      <div class="modal-body">
            <div class="gift-box col-md-12">
                <span class='giftText'>Regala il ticket <b><span id="labelTicketNumber"></span></b> via: <b><span class="labelProvider"></span></b></span>
                <div class="gift-btn-container">
                    <div class="col-md-2 pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Email" name='1'>    
                    </div>
                    <div class="col-md-2 pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Chi segui" name='2'>    
                    </div>
                    <div class="col-md-2 pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Chi ti segue" name='3'>    
                    </div>
                    <div class="col-md-2 pull-left">
                        <input class="btn btn-info gift-ticket-social-btn fb-gift" type="button" value="Facebook" >    
                    </div>
                    <div class="col-md-2 pull-left">
                        <input class="btn btn-info gift-ticket-social-btn gp-gift" type="button" value="Google" >    
                    </div>
                    <div class="clearfix"></div>
                    <div class="em"><?php echo Yii::t('wonlot','Per regalare via social network occorre abilitare i pop-up.'); ?></div>
                    <div class="em"><?php echo Yii::t('wonlot','Se la finestra di Facebook o Google+ non si apre controllare nella barra in alto per abilitare i pop-up.'); ?></div>
                    <?php $this->widget('ext.hoauth.widgets.HOAuthShare'); ?>
                </div>
                <div class="clearfix"></div>
                <hr/>
                <div class="friend-scroll">
                    <div class="box-spinner" style="display: none;">
                        <table class="load-inside"><tr><td>
                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/loading-dots.gif", "Loading"); ?>
                        </td></tr></table>
                    </div>
                    <?php $this->renderPartial('/lotteries/_friendList'); ?>
                </div>
                <script>
                    $(".friend-scroll").slimScroll({
                        height: '300px',
                        size: '5px',
                    });   
                </script>
            </div>
       </div>
       <div class="modal-footer">
          <?php if($isBuy){ ?>
              <button id="gift-back" type="button" class="btn btn-default">Indietro</button>
          <?php } ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
   </div>
</div>
<?php 
    $config = UserOAuth::getConfig(); 
?>
<script>
    // globals
    var baseTicketUrl = '<?php echo Yii::app()->createAbsoluteUrl('lotteries/getGift?tid='); ?>';
    var baseUrl = '<?php echo Yii::app()->createAbsoluteUrl(''); ?>';
    var baseGiftMsg = '<?php echo Yii::t('wonlot','Ecco un Ticket in regalo per te!'); ?>';
    var noUserErrorMsg = '<?php echo Yii::t('wonlot','Nessun utente selezionato!'); ?>';
    (function() {
        var po = document.createElement('script');
        po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
      })();
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
      var gpdefaults = {
            clientid: "<?php echo $config['providers']['Google']['keys']['id'];?>",
            callback: $.signinCallback,
            cookiepolicy: 'single_host_origin',
            requestvisibleactions: 'http://schemas.google.com/AddActivity',
            scope: 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
      };
      var gpInviteBtnOptions = {
                clientid: "<?php echo $config['providers']['Google']['keys']['id'];?>",
                cookiepolicy: 'single_host_origin',
                prefilltext: 'Create your Google+ Page too!',
                calltoactiondeeplinkid: '/pages/create'
      };
      $.signinCallback = function(authResult){
        gapi.client.load('plus','v1', function(){
          if (authResult['access_token']) {
            alert("OK");
            alert(JSON.stringify(authResult));
          } else if (authResult['error']) {
            alert("Error");
          }
          console.log('authResult', authResult);
        });
      };
      window.fbAsyncInit = function() {
        FB.init({
          appId      : "<?php echo $config['providers']['Facebook']['keys']['id'];?>",
          status     : true,
          xfbml      : true
        });
      };
      var fbScope={scope: 'email,user_birthday'};
</script>