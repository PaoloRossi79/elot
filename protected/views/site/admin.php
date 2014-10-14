
<div>Pagina di ADMIN</div>
<div>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('users/admin'); ?>">Utenti</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('userWithdraw/admin'); ?>">Richieste prelievo</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('lotteryPaymentRequest/admin'); ?>">Pagamenti lotterie</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('userSpecialOffers/admin'); ?>">Promozioni</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('lotteries/random'); ?>">Random</a>
    <a class="btn btn-primary" href="<?php echo $this->createUrl('lotteries/cronLottery'); ?>">Esegui Cron lottery</a>
</div>

<div class="panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo Yii::t('wonlot','Errori'); ?></h3>
    </div>
    <div class="panel-body">
        <?php if($errors){ ?>
            <?php foreach($errors as $cat=>$list){ ?>
                <ul class="list-unstyled">
                    <li>
                        <span class="col-md-4"><?php echo Yii::t('wonlot','Lotterie passate in status: ').'<strong>'.$cat.'</strong>'; ?></span>
                        <span class="col-md-8">
                            <?php if(!empty($list)){ ?>
                                <ul class="list-unstyled">
                                    <?php foreach($list as $e){ ?>
                                        <li><?php echo $e; ?></li>
                                    <?php } ?>
                                </ul>
                            <?php } else {?>
                                <div><?php echo Yii::t('wonlot','Nessun errore'); ?></div>
                            <?php } ?>
                        </span>
                    </li>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>
</div>
