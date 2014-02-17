<div class="modal fade" id="<?php echo 'buyModal-'.$data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Buy Ticket</h4>
      </div>
      <div class="modal-body">
            <?php 
                $checkBuy = $this->userCanBuy($data->id);
                if($checkBuy){ 
            ?>
                <?php /** @var TbActiveForm $form */
                $formModel = new BuyForm;
                $formModel->lotId = $data->id;
                $form = $this->beginWidget(
                    'CActiveForm',
                    array(
                        'id' => 'horizontalForm',
                    )
                ); 
                echo $form->hiddenField($formModel,'lotId'); 
                ?>
                <div class="modal-body">
                    <?php echo CHtml::ajaxButton ("Buy for You!",
                              CController::createUrl('lotteries/buyTicket'), 
                              array('update' => '.data-'.$data->id,
                                'type' => 'POST', 
                                'data'=>'js:jQuery(this).parents("form").serialize()'
                              )); ?>
                    <p> OR </p>
                    <?php echo CHtml::ajaxButton ("Buy for a friend!",
                              CController::createUrl('lotteries/buyTicket'), 
                              array('update' => '.data-'.$data->id,
                                'type' => 'POST', 
                                'data'=>'js:jQuery(this).parents("form").serialize()'
                              )); ?>
                    <?php echo $form->textField($formModel,'email',array('hint' => 'Your friend email...')); ?>
                    <?php 
                        $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
                        echo $form->dropDownList($formModel,'offerId',$offersType);
                    ?>

                </div>
                <?php $this->endWidget(); ?>

                <div class="modal-footer">

                    <div class="">
                        <div class="data-<?php echo $data->id; ?>">
                            <?php 
                                $addData = array('version' => 'complete', 'data' => $data);
                                $this->renderPartial('_buyAjax', $addData); 
                            ?>
                        </div>
                    </div>
                </div>
            <?php } elseif(Yii::app()->user->isGuest()){ ?>
                <h4>LOGIN TO BUY!</h4>
                <?php $this->renderPartial('/site/login',array('showLogin'=>true)); ?>
            <?php } elseif($data->owner_id == Yii::app()->user->id){ ?>
                <h4>CANNOT BUY YOUR LOTTERY!</h4>
            <?php } elseif($checkBuy == Lotteries::errorCredit) { ?>
                <h4>NOT ENOUGH CREDIT!</h4>
            <?php } elseif($checkBuy == Lotteries::errorStatus) { ?>
                <h4>LOTTERY IN WRONG STATUS</h4>
            <?php } ?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>