<div class="user-box" id="<?php echo $data->id; ?>">
    <?php if($data){ ?>
    <div>
        <div class="user-img">
            <?php echo Users::model()->getImageTag($data); ?>
        </div>
    </div>
    <div>
        <div class="list-text">
            <p><span class="lot-b-text"><?php echo CHtml::encode($data->username); ?></span></p>
            <p><span class="">ID: <?php echo CHtml::encode($data->id); ?></span></p>
        </div>
    </div>
    <div>

    </div>
    <?php } ?>
</div>