<style>
    #commission-data {
        display: none;
    }
</style>

<div class="span3">
    <?php echo $this->inputField; ?>
</div>

<div id="commission-data">
    <div class="span3">
        <?php $value = $this->model->{$this->attribute}; ?>
        <?php echo Yii::t('wonlot','Wonlot commission'); ?> : <?php echo $this->wlPerc; ?>%
    </div>
    <div class="span3">
        <?php echo Yii::t('wonlot','Your earning'); ?> : <span id="userEarning"><?php echo $value - ($value * $this->wlPerc / 100); ?></span>
    </div>
</div>
<div id="commission-missing">
    <div class="span12">
        <?php echo Yii::t('wonlot','If you don\'t set a price value on your lottery will not be shown a probability value (ie. 1 on X)'); ?></span>
    </div>
</div>