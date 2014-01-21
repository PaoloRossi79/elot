
<?php if(is_null($result)){
  $display="display: none;";  
} else {
  $display="display: block;";
}
$dataId=0;
$lot=null;
if(isset($data->id)){
    $dataId=$data->id;
} else {
    $dataId=$id;
}
?>
<?php if((isset($addData['version']) && $addData['version'] === "complete") || ($version === "complete")){ ?>
    <div class="<?php echo $type; ?>" style="<?php echo $display;?>">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong><?php echo $result; ?></strong> <?php echo $msg; ?>
    </div>
<?php } ?>
<div class="">You have already bought: <?php echo CHtml::encode(is_array($this->ticketTotals) ? $this->ticketTotals[$dataId] : $this->ticketTotals); ?></div>
