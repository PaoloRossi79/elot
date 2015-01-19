<?php 
    if($location){
        //header("Location: " . $location );
        echo CHtml::link("Procedi al pagamento", $location, array('id'=>'goBank', 'class'=>'hidden'));
    ?>
        <h4><?php echo Yii::t("wonlot","Stai per accedere alla pagina di pagamento bancario ... "); ?></h4>
        <script type="text/javascript">
            $(document).ready(function(){
                $.goBank();
            });
        </script>
    <?php
    } else {
        $creditForm = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'userWallet-form',
                //'action'=>CController::createUrl('users/buyCredit'),
                'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
            )
        );
    ?>

    <?php if($errorMsg){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong id="alert-strong"></strong><span id="alert-msg"><?php echo $errorMsg;?></span>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6">
            <h4><?php echo Yii::t('wonlot','Scegli un importo'); ?></h4>
            <?php 
            $opt=array('template'=>'{input} {beginLabel}{labelTitle} euro{endLabel}');
            echo $creditForm->radioButtonList($model, "creditOption", Yii::app()->params['buyCreditOptions'], $opt); 
            ?>
        </div>
        <div>
            <?php echo $creditForm->errorSummary($model); ?>
        </div>
        <div class="col-md-6">
            <h4><?php echo Yii::t('wonlot','Altro importo'); ?></h4>
            <div><b><em><?php echo Yii::t('wonlot','La quantità minima di Wmoney acquistabile è pari a 7€.'); ?></em></b></div>
            <div>
                <div><?php echo $creditForm->textField($model, 'creditValue', array('class' => 'span3','size'=>45,'maxlength'=>45,'placeholder'=>Yii::t('wonlot','Importo da acquistare...'))); ?> €</div>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>     
<?php } ?>     