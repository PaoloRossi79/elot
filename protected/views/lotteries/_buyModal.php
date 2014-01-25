<?php $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array('id' => 'buyModal-'.$data->id)
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Modal header</h4>
    </div>

    
    <?php 
        $checkBuy = $this->userCanBuy($data->id);
        if($checkBuy){ 
    ?>
        <?php /** @var TbActiveForm $form */
        $formModel = new BuyForm;
        $formModel->lotId = $data->id;
        $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'horizontalForm',
                'type' => 'horizontal',
            )
        ); 
        echo $form->hiddenField($formModel,'lotId'); 
        ?>
        <div class="modal-body">
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'type' => 'primary',
                    'buttonType' => 'ajaxLink',
                    'label' => 'Buy for You!',
                    'url' => CController::createUrl('lotteries/buyTicket'), 
                    'ajaxOptions' => array(
                        'update' => '.data-'.$data->id,
                        'type' => 'POST', 
                        'data'=>'js:jQuery(this).parents("form").serialize()',
                    ),
                )
            ); ?>
            <p> OR </p>
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'type' => 'primary',
                    'buttonType' => 'ajaxSubmit',
                    'label' => 'Buy for a friend!',
                    'url' => CController::createUrl('lotteries/buyTicket'), 
                    'ajaxOptions' => array(
                        'update' => '.data-'.$data->id,
                        'type' => 'POST', 
                        'data'=>'js:jQuery(this).parents("form").serialize()',
                    ),
                )
            ); ?>
            <?php echo $form->textFieldRow(
                $formModel,
                'email',
                array('hint' => 'Your friend email...')
            ); ?>
            
            <?php 
                $offersType = UserSpecialOffers::model()->getUserSpecialOffersDropdown();
                echo $form->dropDownListRow(
                    $formModel,
                    'offerId',
                    $offersType
                );
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
            <?php $this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'label' => 'Close',
                    'url' => '#',
                    'htmlOptions' => array('data-dismiss' => 'modal'),
                )
            ); ?>
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
<?php $this->endWidget(); ?>