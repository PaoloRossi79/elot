<div id="user-tickets">
        
    <h2><?php echo Yii::t('wonlot','Ticket'); ?></h2>
    <div class="main-table col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><?php echo Yii::t('wonlot','Lotteria'); ?></td>
                </tr>
            </thead>
            <?php foreach($model as $m){ ?>
            <tr>
                <td>
                    <div class="list-img">
                        <?php echo CHtml::image($this->getImageUrl($m,'mediumSquaredThumb'),'Lottery Image'); ?>
                    </div>
                    <div class="list-text">
                        <?php echo Yii::t("wonlot","Stato:"); ?> <span class="lot-b-text"><?php echo CHtml::encode($m->getStatusText()); ?></span>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>    
</div>