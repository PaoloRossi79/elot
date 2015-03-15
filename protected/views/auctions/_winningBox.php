<div class="panel-body">
    <dl class="dl-horizontal">
        <dt><?php echo Yii::t('wonlot','Utente'); ?></dt>
        <dd>
            <span class="user-small-avatar-container winningUser">
                <input class="winningUserHidden" type="hidden" value="<?php echo $data->winningUser->id; ?>">
                <a href="<?php echo CController::createUrl('users/view/'.$data->winningUser->id);?>">
                    <?php echo Users::model()->getImageTag($data->winningUser); ?>
                    <span class="small-username"><?php echo CHtml::encode($data->winningUser->username); ?></span>
                </a>
            </span>
        </dd>
    </dl>
    <dl class="dl-horizontal">
        <input class="winningValHidden" type="hidden" value="<?php echo $data->winning_sum; ?>">
        <dt><?php echo Yii::t('wonlot','Punteggio'); ?></dt>
        <dd><b class="winningVal"><?php echo $data->winning_sum; ?></b></dd>
    </dl>
</div>