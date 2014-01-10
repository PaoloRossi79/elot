
<?php if(is_null($result)){
  $display="display: none;";  
} else {
  $display="display: block;";
}
$dataId=0;
$lot=null;
if(isset($data->id)){
    $dataId=$data->id;
    $lot=$data;
} else {
    $dataId=$id;
    $lot=$data;
}
?>
<div class="<?php echo $type; ?>" style="<?php echo $display;?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $result; ?></strong> <?php echo $msg; ?>
</div>
<div class="">You have already bought: <?php echo CHtml::encode($this->ticketTotals[$dataId] ? $this->ticketTotals[$dataId] : 0); ?></div>
