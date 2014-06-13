<div class="modal fade" id="gift-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <?php /** @var TbActiveForm $form */
        $formModel = new BuyForm;
        $formModel->lotId = $dataId;
        $formModel->ticketGiftId = null;
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'buyLotteryForm',
            )
        ); 
        echo $form->hiddenField($formModel,'lotId'); 
        echo $form->hiddenField($formModel,'ticketGiftId'); 
    ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Regala Ticket</h4>
      </div>
      <div class="modal-body">
        <?php $checkBuy = $this->userCanBuy($data->id);
            if($checkBuy === true){ ?>                    
                <div class="col-md-6">
                    <div class="modal-gallery-subtitle no-margin">Hai già comprato <b><?php echo count($this->ticketTotals); ?></b> ticket!</div>
                    <?php if(isset($data->id) && $data->winning_id == Yii::app()->user->id){ ?>
                        <div class="modal-gallery-subtitle no-margin">Sei in testa!!!</div>
                    <?php } ?>
                    <div class="modal-gallery-subtitle no-margin">Il tuo punteggio è <b><?php echo $this->actualWeight; ?></b> punti!</div>
                </div>
                <div class="col-md-6">
                    <div id="alert-box" class="alert alert-error" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="alert-strong"></strong><span id="alert-msg"></span>
                    </div>
                    <div id="win-box" class="alert alert-success" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong id="win-strong"></strong><span id="win-msg"></span>
                    </div>
                    <p style="display: none;" class="cannot-buy">Mi spiace...non puoi più comprare ticket per questa lotteria!</p>
                </div>
                <div class="col-md-12 center-float">    
                    <div class="ticketGrid">
                        <!-- NEW STYLE: come ticket con bottone sotto! -->
                        <div class="gift-box col-md-12">
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
                
        <?php } elseif($checkBuy == Lotteries::errorGuest) { ?>
            <h4>LOGIN TO BUY!</h4>
            <?php $this->renderPartial('/site/login',array('showLogin'=>true)); ?>
        <?php } elseif($checkBuy == Lotteries::errorStatus) { ?>
            <h4>LOTTERY IN WRONG STATUS</h4>
        <?php } elseif($checkBuy == Lotteries::errorCredit) { ?>
            <h4>NOT ENOUGH CREDIT!</h4>
        <?php } elseif($checkBuy == Lotteries::errorOwner) { ?>
            <h4>CANNOT BUY YOUR LOTTERY!</h4>
        <?php } ?>
       </div>
       <div class="modal-footer">
           <?php 
                $formModel->offerId = -1;
                $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
                if(!empty($offersType)){
                    echo $form->labelEx($formModel,'offerId');
                    echo $form->dropDownList($formModel,'offerId',$offersType,array('empty'=>Yii::t("wonlot",'Nessuna offerta')));
                }
           ?>
           <?php echo CHtml::ajaxLink (
                   $text = "Regala!",
                   $url = CController::createUrl('lotteries/giftTicket'), 
                   $ajaxOptions=array (
                        'type'=>'POST',
                        'dataType'=>'json',
                        'data'=>'js:$("#buyLotteryForm").serialize()',
                        'success'=>'function(res){ jQuery("#your_id").html(html); }'
                        ), 
                   $htmlOptions=array ('name'=>'giftBtn', 'class'=>'btn btn-primary buy-btn')
                    ); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
       </div>
    </div>
   </div>
   <?php $this->endWidget(); ?>
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