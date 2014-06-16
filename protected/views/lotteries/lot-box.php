<div class="lot-box-item">
    
    
    <div class="lot-box-int">
        <div class="lot-box-first-row"> 
            <div class="pull-left"> 
                <div class="jam-round status-<?php echo $data->status?>"></div>
            </div>
            <div class="pull-right lot-seller-war"> 
                <p class="identity-text bg-success"><?php echo Yii::t('wonlot','VENDITORE GARANTITO'); ?></p>
            </div>
        </div>
        <div class="center-block lot-name-cont">
            <div class="lot-name">
                <a href="/index.php/lotteries/view/<?php echo $data->id;?>">
                    <h3><?php echo $data->name; ?></h3>
                </a>
            </div>
        </div>
        
        <div class="lot-img"> 
            <a href="/index.php/lotteries/view/<?php echo $data->id;?>">
                <?php echo CHtml::image($this->getImageUrl($data,'mediumSquaredThumb'),'Lottery Image',array('class'=>'img-thumbnail')); ?>
            </a>
        </div>
        <div class="lot-break"></div>
        <div class="lot-box-first-row">
            <div class="lot-wlticket col-md-3">
                <img src="/images/site/icon-ticket.png">
            </div>
            <div class="lot-value col-md-6">
                <h3>= <?php echo Chtml::encode((float)$data->ticket_value+0);?></h3>
            </div>
            <div class="lot-wlmoney col-md-3">
                <img src="/images/site/wl-money.png">
            </div>
        </div>
        <?php if($data->max_ticket){ ?>
            <div class="lot-box-first-row">
                <p class="text-left pull-left win-perc-text"><?php echo Yii::t('wonlot','Punteggio attuale');?> <span class="win-perc"><?php echo Chtml::encode($data->winning_sum);?></span></p>
            </div>
        <?php } ?>
    </div>
    <div class="lot-box-hover">
        <div class="lot-icons-cont">
            <div class="star-cont">
            <?php if($this->userId != $data->owner->id && !Yii::app()->user->isGuest){ ?>
                <?php if(!in_array($data->id,$this->favLots)){ ?>
                    <?php 
                    echo CHtml::ajaxLink('', '#',array(),array('id'=>'favLotBtn-'.$data->id,'name'=>$data->id,'class'=>'favLotBtn setFav btn btn-default btn-lg glyphicon glyphicon-star-empty'));
                    ?>

                <?php } else { ?>
                    <?php echo CHtml::ajaxLink('', '#',array(),array('id'=>'unfavLotBtn-'.$data->id,'name'=>$data->id,'class'=>'favLotBtn unsetFav btn btn-default btn-lg glyphicon glyphicon-star'));?>
                <?php } ?>
            <?php } ?>
            </div>
            <div class="cocc-cont">
                <img src="/images/site/coccarda-small.png">
            </div>
        </div>
        <div class="prize-desc-over-box">
            <a href="<?php echo CController::createUrl('lotteries/view/'.$data->id);?>">
                <div class="prize-desc-over center-block">
                    <h2><?php echo $data->name;?></h2>
                </div>
            </a>
        </div>
        
        <div>
            <div class="row under-border-row">
                <div class="col-md-6 small-username">
                    <div>
                        <?php echo Yii::t('wonlot','Venditore:'); ?>
                    </div>
                    <div>
                        <?php if(!Yii::app()->user->isGuest){ ?>
                            <a href="<?php echo CController::createUrl('users/view/'.$data->owner_id);?>">
                                <span class="small-username"><?php echo CHtml::encode($data->owner->username); ?></span>
                            </a>
                        <?php } else { ?>
                            <span class="small-username"><?php echo CHtml::encode($data->owner->username); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if(!Yii::app()->user->isGuest){ ?>
                        <a href="<?php echo CController::createUrl('users/view/'.$data->owner_id);?>">
                            <?php echo CHtml::image("/images/userProfiles/".$data->owner_id."/smallThumb/".$data->owner->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                        </a>
                    <?php } else { ?>
                        <?php echo CHtml::image("/images/userProfiles/".$data->owner_id."/smallThumb/".$data->owner->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 small-username"><?php echo Yii::t('wonlot','Località'); ?></div>
                <div class="col-md-6">
                    <span class="small-username"><?php echo CHtml::encode(($data->location->addressCity) ? $data->location->addressCity : $data->location->address); ?></span>
                    <?php if($data->distance){ ?>
                        <span class="small-username">Distanza:<?php echo CHtml::encode(number_format((float)$data->distance,3)); ?> Km.</span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>