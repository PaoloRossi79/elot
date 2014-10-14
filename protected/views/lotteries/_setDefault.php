
<?php if(is_null($result)){
  $display="display: none;";  
} else {
  $display="display: block;";
}
?>

<div class="<?php echo $type; ?>" style="<?php echo $display;?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong><?php echo $result; ?></strong> <?php echo $msg; ?>
</div>
