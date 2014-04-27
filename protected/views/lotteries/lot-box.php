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
                <h3><?php echo " = ".$data->ticket_value;?></h3>
            </div>
            <div class="lot-wlmoney col-md-3">
                <img src="/images/site/wl-money.png">
            </div>
        </div>
    </div>
    <div class="lot-box-hover">
        <div class="lot-icons-cont">
            <div class="star-cont">
                <?php if(!in_array($data->id,$this->favLots)){ ?>
                    <?php 
                    /*echo CHtml::ajaxLink(
                        $label = '', 
                        $url = CController::createUrl('lotteries/setFavorite'),  
                        $ajaxOptions=array (
                            'type'=>'POST',
                            'dataType'=>'json',
                            'data'=>array('lotId'=>$data->id),
                            'success'=>'function(data){                                             
                                alert(data);
                                alert($(this));
                                if(data){
                                    $(this).removeClass("glyphicon-star-empty");
                                    $(this).addClass("glyphicon-star");
                                    $(this).click(function(){return false;});
                                } else {
                                    //alert("Errore");
                                }
                            }'
                        ), 
                        $htmlOptions=array('name'=>'favLotBtn-'.$data->id, 'class'=>'btn btn-default btn-lg glyphicon glyphicon-star-empty')
                    );*/
                    echo CHtml::ajaxLink('', '#',array(),array('id'=>'favLotBtn-'.$data->id,'name'=>$data->id,'class'=>'favLotBtn setFav btn btn-default btn-lg glyphicon glyphicon-star-empty'));
                    ?>
                
                <?php } else { ?>
                    <?php echo CHtml::ajaxLink('', '#',array(),array('id'=>'unfavLotBtn-'.$data->id,'name'=>$data->id,'class'=>'favLotBtn unsetFav btn btn-default btn-lg glyphicon glyphicon-star'));?>
                <?php } ?>
            </div>
            <div class="cocc-cont">
                <img src="/images/site/coccarda-small.png">
            </div>
        </div>
        <div>
            <h2><?php echo $data->prize_desc;?></h2>
        </div>
    </div>
</div>