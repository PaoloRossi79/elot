<div class='well col-md-12 gift-credit-box'>
    <?php echo $this->renderPartial('_creditActionPanel', array('model'=>$model),true); ?>
</div>
<?php if($this->confirmMsg){ ?>
    <?php if($this->confirmMsg["res"]){ ?>
        <div class='well col-md-12 gift-credit-box alert-success'>
            Operazione eseguita...a breve ti arrivano i money
        </div>
    <?php } else { ?>
        <div class='well col-md-12 gift-credit-box alert-success'>
            Operazione fallita...no money!
        </div>
    <?php }  ?>
<?php } ?>
<div class='well col-md-12'>
    <?php 
    echo CHtml::ajaxButton ("Mostra transazioni",
        CController::createUrl('UserTransactions/userIndex'), 
        array('update' => '#user-trans',
              'beforeSend'=>'js:function(event){
                    $("#user-promo").fadeOut();
                    $("#user-trans").fadeIn();
                }'
        ),array('id'=>'show-trans')
    );
    echo CHtml::ajaxButton("Nascondi transazioni",'#',
        array('success'=>'js:function(event){
                              $("#user-trans").fadeOut();
                              $("#show-trans").click(function(ev){
                                  $("#user-trans").fadeIn();
                              });
                          }'
        ),array('id'=>'hide-trans')
    );
    echo CHtml::ajaxButton ("Mostra Promozioni",
        CController::createUrl('UserSpecialOffers/userIndex'), 
        array('update' => '#user-promo',
              'beforeSend'=>'js:function(event){
                    $("#user-trans").fadeOut();
                    $("#user-promo").fadeIn();
                }'
        ),array('id'=>'show-promo')
    );
    echo CHtml::ajaxButton("Nascondi Promozioni",'#',
        array('success'=>'js:function(event){
                              $("#user-promo").fadeOut();
                              $("#show-promo").click(function(ev){
                                  $("#user-promo").fadeIn();
                              });
                          }'
        ),array('id'=>'hide-promo')
    );
    echo $this->renderPartial('_transactionsEmpty', array(),true);
    echo $this->renderPartial('_promotionsEmpty', array(),true);
    ?>
</div>
