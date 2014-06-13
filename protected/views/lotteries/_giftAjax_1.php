<div id="gift-<?php echo $data->id; ?>">
    <div class="ticket-list">
        <?php 
        if(!is_null($result)){
          if(!$canBuyAgain){
              $cs = Yii::app()->clientScript;
              $cs->registerScript('blockBuy', '$("input[name=buyBtn]").attr("disabled", "disabled").fadeOut();$(".cannot-buy").fadeIn()', CClientScript::POS_READY);
          } 
          if($result == "OK!"){
              ?>
                <script>
                    $('#alert-box').removeClass('alert-error');
                    $('#alert-box').addClass('alert-success');
                    $('#alert-box').fadeIn();
                </script>
              <?php
          } else {
              ?>
                <script>
                    $('#alert-box').removeClass('alert-success');
                    $('#alert-box').addClass('alert-error');
                    $('#alert-box').fadeIn();
                </script>
              <?php
          }
          ?>
            <script>
                $('#alert-strong').text("<?php echo $result; ?>");
                $('#alert-msg').text("<?php echo $msg; ?>");
            </script>
          <?php
        }
        
        $dataId=0;
        $lot=null;
        if(isset($data->id)){
            $dataId=$data->id;
        } else {
            $dataId=$id;
        }
        ?>
        
        
    </div>
</div>