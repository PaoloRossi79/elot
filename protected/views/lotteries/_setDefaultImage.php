<div id="defImageBox">
<?php 
    $lotId=($id) ? $id : $data->id;
    if($data->cloneId){
        $this->imgList=$this->getImageList($data->cloneId);   
    } else {
        $this->imgList=$this->getImageList($lotId);   
    }
    if(!$data)
        $data=$this->loadModel($lotId);
?> 

<?php foreach($this->imgList as $k=>$img){ 
  $displayAlert="display: none;";
  if($img->file !== $data->prize_img){
      $display="display: inline;";  
      $defClass="";
  } else {
      $display="display: none;";  
      $defClass="red-box";
      if(isset($result)){
        if($result){
          $display="display: none;";
          $displayAlert="display: block;";
          $defClass="red-box";
        } else {
          $display="display: inline;";  
          $displayAlert="display: block;";
          $defClass="";
        }
      }
  }
?>
    <div class="updateImgBox">
        <div class="thumbnail <?php echo $defClass; ?>">
            <?php echo CHtml::image($this->getImageUrl($img,"smallSquaredThumb"),'Prize image '.$k); ?>
<!--            <div class="<?php echo $type; ?>" style="<?php echo $displayAlert;?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $msg; ?>
            </div>-->
            <div class="caption">
              <?php if($lotId){ ?>
                    <?php echo CHtml::ajaxButton ("Set Default",
                                      CController::createUrl('lotteries/setDefault',array("img"=>$img->file,"lotId"=>$data->id)), 
                                      array('update' => '#defImageBox'),
                                      array('style' => $display,'class'=>'btn btn-green')
                    );?>
                    <?php echo CHtml::ajaxButton ("Delete",
                                      CController::createUrl('lotteries/deleteImg',array("img"=>$img->file,"lotId"=>$data->id)), 
                                      array('update' => '#defImageBox'),
                                      array('style' => $display,'class'=>'btn btn-danger')
                    );?>
                    <?php if($img->file === $data->prize_img){ ?>
                      <div><strong>DEFAULT IMAGE</strong></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<div class="clear"></div>