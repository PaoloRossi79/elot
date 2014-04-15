<div class="friends">
    <div class="friends-list">
        <table>
            <?php if($list) { ?>
                <script>
                    $('.box-spinner').hide();
                </script>
                <?php foreach ($list as $f) { ?>
                    <tr>
                        <td><img style="width: 50px; height: 50px;" src="<?php echo $f->photoURL; ?>"></td>
                        <td><?php echo $f->displayName; ?></td>
                        <td>
                            <button class="btn btn-primary feedShare" id='<?php echo $f->identifier; ?>'>
                                <?php echo Yii::t('wonlot','Regala'); ?>
                            </button>
                            <?php 
                            $msg = urlencode("Ti ho regalato un biglietto su Wonlot.com!");
                            $baseUrl = Yii::app()->getBaseUrl(true);
                            $url = "https://www.facebook.com/dialog/feed?app_id=$appId&display=popup&caption=$msg&link=$baseUrl&redirect_uri=$baseUrl/lotteries/gift";
                            ?>
                            <!--<a class="feedShare">Regala!</a>-->
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>				
    <div class="clear"></div>
</div>
<script>
    $(".friends-list").slimScroll({
        height: '300px',
        size: '5px',
    });    
    $('.feedShare').click(function(event) {
            var button = $(this);
            
            FB.ui({method: 'feed',
                message: 'Ti ho regalato un biglietto su Wonlot.com!',
                link: '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#BuyForm_ticketGiftId").val(),
    //                                to: $(this).attr('id');
                to: '100004725912341'
            }, function(response){
                if(!response){
                    
                } else {
                    $.ajax({
                        'type':'POST',
                        'url':'/lotteries/gift',
                        'cache':false,
                        'data':{'provider': $('#labelProvider').text(), 'userId': button.attr('id'), 'ticketId': $("#BuyForm_ticketGiftId").val()},
                        'success':function(result){
                            var res = JSON.parse(result);
                            if(res){
                                if(res.exit == 1){
                                    $('#alert-box').removeClass('alert-error');
                                    $('#alert-box').addClass('alert-success');
                                    $('#alert-strong').text("Regalato ");
                                    $('#alert-msg').text("il ticket n° "+$("#labelTicketNumber").text());
                                    $('#alert-box').fadeIn();
                                    $("#gift-modal").modal('hide');
                                    $('#buy-modal').modal('show');
                                    $("#"+res.ticketId).parent().html('<p><span class="bg-success">Regalato!</span></p>');
                                } else if(res.exit == 0){
                                    alert(res.msg);
                                }
                            }
                        }
                    });
                    
                }
            });
      });
</script>
