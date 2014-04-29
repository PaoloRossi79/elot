<div class="modal fade" id="gift-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Regala Ticket</h4>
      </div>
      <div class="modal-body">
            <div class="gift-box">
                Regala il ticket <b><span id="labelTicketNumber"></span></b> via: <b><span id="labelProvider"></span></b>
                <div class="gift-btn-container">
                    <div class="width-33perc pull-left">
                        <input class="btn btn-info" type="button" value="Email" id="gift-email">    
                    </div>
                    <?php $this->widget('ext.hoauth.widgets.HOAuthShare'); ?>
                </div>
                <hr/>
                <div class="friend-scroll">
                    <div class="box-spinner" style="display: none;">
                        <table class="load-inside"><tr><td>
                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/loading-dots.gif", "Loading"); ?>
                        </td></tr></table>
                    </div>
                    <?php $this->renderPartial('/lotteries/_friendList'); ?>
                </div>
                <script>
                    $(".friend-scroll").slimScroll({
                        height: '300px',
                        size: '5px',
                    });   
                </script>
            </div>
       </div>
       <div class="modal-footer">
          <?php if($isBuy){ ?>
              <button id="gift-back" type="button" class="btn btn-default">Indietro</button>
          <?php } ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
   </div>
</div>