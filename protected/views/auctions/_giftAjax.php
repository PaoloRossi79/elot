<div id="gift-main">
    <script>
        $(".gift-ticket-box").hide();
    </script>
    <div class="ticket-list" class="container-fluid">
        <?php
        $friendBoxSize = 300;
        if(!is_null($result)){
          if(!$canBuyAgain){
              $cs = Yii::app()->clientScript;
              $cs->registerScript('blockBuy', 
                '$("input[name=buyBtn]").attr("disabled", "disabled").fadeOut();
                 $(".cannot-buy").fadeIn()'
              , CClientScript::POS_READY);
          } 
        }
        ?>
        <?php /** @var TbActiveForm $form */
        $formModel = new GiftForm;
        $formModel->lotId = $data->id;
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'giftLotteryForm',
            )
        ); 
        echo $form->hiddenField($formModel,'lotId'); 
        echo $form->hiddenField($formModel,'giftToUserId'); 
        echo $form->hiddenField($formModel,'giftToUsername'); 
        echo $form->hiddenField($formModel,'giftToEmail'); 
        echo $form->hiddenField($formModel,'provider'); 
        ?>
        
        <div class="buy-box container-fluid">
            <div class="col-md-12">
                <div class="box-panel-win panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Attualmente in testa'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal col-md-6">
                            <dt><?php echo Yii::t('wonlot','Utente'); ?></dt>
                            <dd>
                                <span class="user-small-avatar-container winningUser">
                                    <input class="winningUserHidden" type="hidden" value="<?php echo $data->winningUser->id; ?>">
                                    <a href="<?php echo CController::createUrl('users/view/'.$data->winningUser->id);?>">
                                        <?php //echo CHtml::image("/images/userProfiles/".$data->winningUser->id."/smallThumb/".$data->winningUser->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                                        <?php echo Users::model()->getImageTag($data->winningUser); ?>
                                        <span class="small-username"><?php echo CHtml::encode($data->winningUser->username); ?></span>
                                    </a>
                                </span>
                            </dd>
                        </dl>
                        <dl class="dl-horizontal  col-md-6">
                            <input class="winningValHidden" type="hidden" value="<?php echo $data->winning_sum; ?>">
                            <dt><?php echo Yii::t('wonlot','WCREDITS totali'); ?></dt>
                            <dd><b class="winningVal"><?php echo $data->winning_sum; ?></b></dd>
                        </dl>
                    </div>
                </div>
                <div class="gift-panel-ok panel panel-success" style="display: <?php echo ($result ? 'block' : 'none'); ?>;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Regalato!'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="ok-gift-box" class="alert alert-success">
                            <strong id="win-strong"></strong><span id="ok-msg"><?php echo $msg; ?></span>
                        </div>
                        <p style="display: none;" class="cannot-buy">Mi spiace...non puoi più comprare ticket per questa Asta!</p>
                    </div>
                </div>
                <div class="gift-panel-err panel panel-danger" style="display: <?php echo ((isset($result) && $result == 0) ? 'block' : 'none'); ?>;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('wonlot','Errore'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <div id="alert-gift-box" class="alert alert-error">
                            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $msg; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ticket-box col-md-12">
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
                    <?php $this->widget('ext.hoauth.widgets.HOAuthShare'); ?>
                </div>
                <div class="clearfix"></div>
                <hr/>
                <div class="friend-box" style="display: none;">
                    <div class="friend-scroll" >
                        <div class="box-spinner" style="display: none;">
                            <table class="load-inside"><tr><td>
                                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/loading-dots.gif", "Loading"); ?>
                            </td></tr></table>
                        </div>
                        <?php $this->renderPartial('/auctions/_friendList',array('form'=>$form,'formModel'=>$formModel,'social'=>$social, 'auction'=>$data)); ?>
                    </div>
                </div>
                <script>
                    $(".friend-scroll").slimScroll({
                        height: '<?php echo $friendBoxSize; ?>px',
                        size: '5px',
                    });   
                </script>
            </div>
        </div>
        <div class="special-offer-block form-group">
        <?php 
            $formModel->offerId = -1;
            $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
            if(!empty($offersType)){ ?>
                <div class="col-md-5">
                    <?php echo $form->labelEx($formModel,'offerId'); ?>
                </div>
                <div class="col-md-6">
                    <?php if($offerId){
                        echo $form->dropDownList($formModel,'offerId',$offersType,array('options' => array($offerId=>array('selected'=>true)),'empty'=>Yii::t("wonlot",'Nessuna offerta'),'class'=>'form-control')); 
                    } else {
                        echo $form->dropDownList($formModel,'offerId',$offersType,array('empty'=>Yii::t("wonlot",'Nessuna offerta'),'class'=>'form-control')); 
                    } ?>
                </div>
            <?php } ?>
        </div>

        <?php $this->endWidget(); ?>
        
    </div>
</div>

<?php 
    $config = UserOAuth::getConfig(); 
?>
<?php if($social['provider']) {?>
<script>
    $.selectProviderAndUser("<?php echo $social['provider']; ?>",<?php echo $social['giftToUserId']; ?>);
</script>
<?php }?>

<script>
    // globals
    var baseTicketUrl = '<?php echo Yii::app()->createAbsoluteUrl('site/register'); ?>';
    var baseUrl = '<?php echo Yii::app()->createAbsoluteUrl(''); ?>';
    var baseGiftMsg = '<?php echo Yii::t('wonlot','Ecco un Wticket in regalo per te su') . Yii::app()->name ."!"; ?>';
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