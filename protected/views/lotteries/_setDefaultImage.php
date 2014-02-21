<div id="defImageBox">
<?php 
    $lotId=($id) ? $id : $data->id;
    $this->imgList=$this->getImageList($lotId);   
    if(!$data)
        $data=$this->loadModel($lotId);
?> 
<ul class="thumbnails">
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
    <li class="span3" id="data-<?php echo $data->id; ?>">
        <div class="thumbnail <?php echo $defClass; ?>">
            <?php echo CHtml::image($this->getImageUrl($data,"mediumThumb"),'Prize image '.$k); ?>
            <div class="<?php echo $type; ?>" style="<?php echo $displayAlert;?>">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $msg; ?>
            </div>
            <div class="caption">
              <?php echo CHtml::ajaxButton ("Set Default",
                                CController::createUrl('lotteries/setDefault',array("img"=>$img,"lotId"=>$data->id)), 
                                array('update' => '#defImageBox'),
                                array('style' => $display,'class'=>'btn btn-green')
              );?>
              <?php echo CHtml::ajaxButton ("Delete",
                                CController::createUrl('lotteries/deleteImg',array("img"=>$img,"lotId"=>$data->id)), 
                                array('update' => '#defImageBox'),
                                array('style' => $display,'class'=>'btn btn-danger')
              );?>
              <?php if($img->file === $data->prize_img){ ?>
                <div><strong>DEFAULT IMAGE</strong></div>
              <?php } ?>
            </div>
        </div>
    </li>
<?php } ?>
</ul>
</div>