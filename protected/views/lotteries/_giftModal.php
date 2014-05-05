<div class="modal fade" id="gift-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Regala Ticket</h4>
      </div>
      <div class="modal-body">
            <div class="gift-box">
                <span class='giftText'>Regala il ticket <b><span id="labelTicketNumber"></span></b> via: <b><span id="labelProvider"></span></b></span>
                <div class="gift-btn-container">
                    <div class="width-33perc pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Email" name='1'>    
                    </div>
                    <div class="width-33perc pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Chi segui" name='2'>    
                    </div>
                    <div class="width-33perc pull-left">
                        <input class="btn btn-info gift-ticket-btn" type="button" value="Chi ti segue" name='3'>    
                    </div>
                    <?php $this->widget('ext.hoauth.widgets.HOAuthShare'); ?>
                </div>
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
<script>
jQuery('body').on('click','.feedShare',function(){
        var button = $(this);
        var provider = $(this).data('provider');
        if(provider == "Facebook"){
            FB.ui({method: 'feed',
                message: 'Ti ho regalato un biglietto su Wonlot.com!',
                link: '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#ticketIdForGift").val(),
    //                                to: $(this).attr('id');
                to: '100004725912341'
            }, function(response){
                if(!response){
                    return false;
                } else if(response.error_code){
                    alert(response.error_msg);
                    return false;
                } else {
                    $.ajax({
                        'type':'POST',
                        'url':'/lotteries/gift',
                        'cache':false,
                        'data':{'provider': $('#labelProvider').text(), 'userId': button.attr('id'), 'ticketId': $("#ticketIdForGift").val()},
                        'success':function(result){
                            var res = JSON.parse(result);
                            if(res){
                                if(res.exit == 1){
                                    $('#alert-box').removeClass('alert-error');
                                    $('#alert-box').addClass('alert-success');
                                    $('#alert-strong').text("Regalato ");
                                    $('#alert-msg').text("il ticket n° "+$("#labelTicketNumber").text());
                                    $('#alert-box').fadeIn();
                                    $("#"+res.ticketId).parent().html('<p><span class="bg-success">Regalato!</span></p>');
//                                    $.updateTicketGift();
                                } else if(res.exit == 0){
                                    alert(res.msg);
                                }
                            }
                        }
                    });

                }
            });
        } else if(provider == "Google"){
            var shareLink = '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#ticketIdForGift").val();
            var baseLink = '<?php echo $this->createAbsoluteUrl(''); ?>';
            var shareMsg = "Ecco un Ticket in regalo per te su WonLot!";
            gpInviteBtnOptions.prefilltext=shareMsg;
            gpInviteBtnOptions.contenturl=baseLink;
            gpInviteBtnOptions.calltoactionurl=shareLink;
            gpInviteBtnOptions.gapiattached=true;
            gpInviteBtnOptions.class="g-interactivepost";
            gapi.interactivepost.render('gpshare-'+$("#ticketIdForGift").val(), gpInviteBtnOptions); 
//            gapi.plus.render('gpshare-'+entityType+'-'+entityId, gpShareBtnOptions);
            $timeout(function(){
                $('#gpshare-'+$("#ticketIdForGift").val()).click();
            },300);
        }
   });
</script>