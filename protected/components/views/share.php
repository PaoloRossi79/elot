<script>
        // globals
        var baseTicketUrl = '<?php echo Yii::app()->createAbsoluteUrl('lotteries/getGift?tid='); ?>';
        var baseUrl = '<?php echo Yii::app()->createAbsoluteUrl(''); ?>';
        var baseGiftMsg = '<?php echo Yii::t('wonlot','Ecco un Ticket in regalo per te!'); ?>';
        var baseLotMsg = '<?php echo Yii::t('wonlot','Vinci con Wonlot"!'); ?>';
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
      !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0];
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;
            js.src="https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(
                    js,fjs
            );
        }
      }(document,"script","twitter-wjs");
</script>
<?php $this->widget('ext.hoauth.widgets.HOAuthShare'); ?>
<div id="gpshare-lot"></div>
<div class="col-md-4">
    <h4><?php echo Yii::t('wonlot','Condividi'); ?></h4>
    <div class="text-block">
        <input name="modelId" type="hidden" value="<?php echo $this->model->id; ?>">    
        <input name="modelType" type="hidden" value="<?php echo get_class($this->model); ?>">    
        <input name="link" type="hidden" value="<?php echo $this->link;?>">    
        <input class="btn btn-info fb-share" type="button" value="Facebook" >    
        <input class="btn btn-info gp-share" type="button" value="Google" >    
        <!--<input class="btn btn-info tw-share" type="button" value="Twitter" >-->
        <a class="btn btn-info tw-share" data-url="<?php echo $this->link;?>" title="<?php echo Yii::t('wonlot','Vinci con Wonlot"!'); ?>" href="https://twitter.com/share">Twitter</a>
        <!--<a href="https://twitter.com/share" id="twitter-share-btn" class="twitter-share-button" data-url="<?php echo $this->link;?>" title="<?php echo Yii::t('wonlot','Vinci con Wonlot"!'); ?>" data-lang="en">Tweet</a>-->
    </div>
</div>
