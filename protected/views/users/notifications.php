<div class="modal-body">
    <div class="box-spinner">
        <table class="load-inside"><tr><td>
            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/loading-dots.gif", "Loading"); ?>
        </td></tr></table>
    </div>
    <table class="table table-hover">

    <?php 
      $notifyProvider = Notifications::model()->getLastNotifications();
      $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$notifyProvider,
            'itemView'=>'/users/notifyRow',   // refers to the partial view named '_post'
            'enableSorting'=>false,
            'enablePagination'=>false,
      ));

    ?>

    </table>
</div>
<div class="modal-footer">
    <?php echo CHtml::link(Yii::t('wonlot','Mostra tutte'), Yii::app()->controller->createUrl('users/allNotify')); ?>
</div>
<script>
    $('.box-spinner').hide();
    $('.notify-unread-count').html(<?php echo $unreadNotifyCount; ?>);
</script>
<?php if(!($unreadNotifyCount > 0)){?>
    <script>
        $('.float-circle').hide(); 
    </script>
<?php }  ?>