<div class="lot-box">
    
    <div class="lot-box-int">
<!--        <div class="lot-cat"> 
            <?php 
                echo CHtml::image('/images/site/'.$data->category->image, $data->category->category_name); 
            ?>
        </div>-->
        <div class="user-check"> 
            <?php 
                echo CHtml::image('/images/site/'.$data->category->image, $data->category->category_name); 
            ?>
        </div>
        <div class="center-block lot-name-cont">
            <div class="lot-name">
                <a href="/index.php/lotteries/view/<?php echo $data->id;?>">
                    <span><?php echo $data->name; ?></span>
                </a>
            </div>
        </div>
        <div class="lot-icons-cont">
            <div class="jam-round status-<?php echo $data->status?>"></div>
            <div class="star-cont">
                <button type="button" class="btn btn-default btn-lg" tooltip="Aggiungi ai preferiti!">
                    <span class="glyphicon glyphicon-star"></span>
                </button>
            </div>
        </div>
        <div class="lot-img"> 
            <a href="/index.php/lotteries/view/<?php echo $data->id;?>">
                <?php echo CHtml::image($this->getImageUrl($data,'mediumSquaredThumb'),'Lottery Image'); ?>
            </a>
        </div>
        <div class="lot-break"></div>
        <div class="lot-value col-md-9">
            <h5><?php echo Yii::t("wonlot","Acquista un wTicket al costo di ").$data->ticket_value;?></h5>
        </div>
        <div class="lot-wlmoney col-md-3">
            <img src="/images/site/wl-money.png">
        </div>
    </div>
</div>