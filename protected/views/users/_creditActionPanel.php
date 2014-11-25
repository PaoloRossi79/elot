<div class="col-md-12" id="buyCreditTarget">
    

        <div>
            <span>
                <h2>
                    <small><?php echo Yii::t('elot','Credito disponibile:'); ?></small>
                    <span>
                        <?php echo CHtml::encode($model->available_balance_amount); ?>
                    </span>
                    <?php echo CHtml::image('/images/site/wl-money.png', 'WL Money',array('class'=>'wl-icon'));?> 
                </h2>
            </span>
        </div>
        <hr/>
    
        
        <button class="btn btn-success" data-toggle="modal" data-target="#buy-credit-modal">
            <em class="glyphicon glyphicon-credit-card"> <?php echo Yii::t('wonlot','Compra credito'); ?></em>
        </button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#with-credit-modal">
            <em class="glyphicon glyphicon-download"> <?php echo Yii::t('wonlot','Preleva credito'); ?></em>
        </button>
        <button class="btn btn-info" data-toggle="modal" data-target="#gift-credit-modal">
            <em class="glyphicon glyphicon-gift"> <?php echo Yii::t('wonlot','Regala credito'); ?></em>
        </button>
        <div class="col-md-6" id="retrive-credit-panel">
            <div class="text-block">
                <?php $this->widget(payLotteryInfoWidget,array('type'=>'retriveCredit')); ?>
            </div>
        </div>
        
</div>
    <?php echo $this->renderPartial('_buyCredit', array('model'=>$model),true); ?>
    <?php echo $this->renderPartial('_withdrawCredit', array('model'=>$model),true); ?>
    <?php echo $this->renderPartial('_giftCredit', array('model'=>$model),true); ?>