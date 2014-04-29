<div class="friends">
    <div class="friends-list">
            <?php if($list) { ?>
                <div class="social-friend-block">
                    <script>
                        $('.box-spinner').hide();
                    </script>
                    <table>
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
                    </table>
                </div>
            <?php }  ?>
            <div class="gift-email-box">
                <?php $form=$this->beginWidget('CActiveForm',array('id'=>'gift-email-form'),array('role' => 'form')); ?>
                
                    <div id="emailFormGroup" class="form-group">
                      <?php echo CHtml::emailField("giftEmail",'',array('id'=>'giftEmail','placeholder' => "Email", 'class' => 'form-control')); ?>                
                        <p id="emailErrorText" class="text-danger"><?php echo Yii::t('wonlot','Email non valida'); ?></p>
                        <p id="emailSuccessText" class="text-success"><?php echo Yii::t('wonlot','Regalo inviato!'); ?></p>
                      <?php echo CHtml::hiddenField("ticketId",null,array('id'=>'ticketIdForGift')); ?>                
                    </div>
                    <?php echo CHtml::ajaxButton ("Regala!",
                        CController::createUrl('lotteries/gift'), 
                        array(
                          'update' => '#data-'.$data->id,
                          'type' => 'POST', 
                          'data'=>array('giftEmail'=>'js:$("#giftEmail").val()','ticketId'=>'js:$("#ticketIdForGift").val()'),
                          'beforeSend'=>'function(){
                               if($("#giftEmail").val()){
                                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                    if(!regex.test($("#giftEmail").val())){
                                        $("#emailFormGroup").addClass("has-error");
                                        $("#emailErrorText").show();
                                        return false;
                                    } 
                               } else {
                                        $("#emailFormGroup").addClass("has-error");
                                        $("#emailErrorText").show();
                                        return false;
                               }
                           }',
                           'success'=>'function(data){
                                var res = $.parseJSON(data);
                                if(res.exit){
                                    $("#emailFormGroup").removeClass("has-error");
                                    $("#emailFormGroup").addClass("has-success");
                                    $("#emailSuccessText").show();
                                    $("#giftBtn").attr("disabled","disabled");
                                    $("#ticket-lot-"+$("#ticketIdForGift").val()).append("<span class=\"ticket-gift-text bg-success\">Regalato!</span>");
                                    $("#"+$("#ticketIdForGift").val()).hide();
                                    setTimeout(function() {
                                        $("#gift-back").click();
                                    }, 3000);
                                } else {
                                    $("#emailErrorText").text(res.msg);
                                    $("#emailErrorText").show();
                                }
                            }',
                        ),
                        array('name'=>'giftBtn', 'class'=>'btn btn-primary buy-btn')
                        ); ?>
                <?php $this->endWidget(); ?>
            </div>
    </div>				
    <div class="clear"></div>
</div>
<script> 
    $('.feedShare').click(function(event) {
            var button = $(this);
            
            FB.ui({method: 'feed',
                message: 'Ti ho regalato un biglietto su Wonlot.com!',
                link: '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#ticketIdForGift").val(),
    //                                to: $(this).attr('id');
                to: '100004725912341'
            }, function(response){
                if(!response){
                    
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
