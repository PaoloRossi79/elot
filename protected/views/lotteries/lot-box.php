<div class="lot-box-item">
    
    <div class="lot-box-int">
        <div class="lot-box-first-row"> 
            <div class="col-md-2"> 
                <div class="jam-round status-<?php echo $data->status?>"></div>
            </div>
            <div class="col-md-8"> 
                <p class="identity-text bg-success">VENDITORE GARANTITO</p>
            </div>
            <div class="col-md-2 lot-cat"> 
                <?php echo CHtml::image('/images/site/'.$data->category->image, $data->category->category_name); ?>
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
                <p class="text-left pull-left win-perc-text"><?php echo Yii::t('wonlot','Hai 1 possibilità su');?> <span class="win-perc"><?php echo Chtml::encode($data->max_ticket);?></span></p>
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
                <div class="prize-desc-over">
                    <h2><?php echo $data->prize_desc;?></h2>
                </div>
            </a>
        </div>
        <div class="lot-creator-over">
            <span class="user-small-vendor-container pull-left">
                <span class="small-username">Venditore:</span>
                <a href="<?php echo CController::createUrl('users/view/'.$data->owner_id);?>">
                    <span class="small-username"><?php echo CHtml::encode($data->owner->username); ?></span>
                </a>
            </span>
            <span class="user-small-avatar-container pull-right">
                <a href="<?php echo CController::createUrl('users/view/'.$data->owner_id);?>">
                    <?php echo CHtml::image("/images/userProfiles/".$data->owner_id."/smallThumb/".$data->owner->profile->img, "User Avatar", array("class"=>"img-thumbnail user-small-thumb")); ?>
                </a>
            </span>
            <div class="clearfix"></div>
        </div>
        
        <div class="lot-location-over pull-left">
            <span class="small-username">Località:</span>
            <span class="small-username"><?php echo CHtml::encode($data->location->addressCity); ?></span>
            <?php if($data->distance){ ?>
                <span class="small-username">Distanza:<?php echo CHtml::encode(number_format((float)$data->distance,3)); ?> Km.</span>
            <?php } ?>
        </div>
    </div>
</div>