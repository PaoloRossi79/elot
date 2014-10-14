<?php
/**
 * @var HOAuthWidget $this
 * @var string $provider name of provider
 */

$additionalClass = $this->onlyIcons ? 'icon' : '';
//$invitation = Yii::app()->user->isGuest ? HOAuthShareAction::t('Sign in with') : HOAuthShareAction::t('Connect with');
$invitation = "";
?>
    <div class="width-33perc pull-left">
        <!--<a href="<?php echo Yii::app()->createUrl('site/oauthshare', array('provider' => $provider)); ?>" class="btn btn-info zocial <?php echo $additionalClass . ' ' . strtolower($provider); ?>"><?php echo "$invitation $provider"; ?></a>-->
        <input type="hidden" name="href" value="<?php echo Yii::app()->createUrl('site/oauthshare', array('provider' => $provider)); ?>">
        <?php echo CHtml::ajaxButton("$invitation $provider",
            $this->controller->createUrl('site/oauthshare',array('provider' => $provider)), 
            array(
              'update' => '#social-friend-list',
              'type' => 'POST', 
//              'success' => 'function(data){
//                    $.updateSocialFriends(data);
//              }',
            ),
            array(
                'class' => "btn btn-info gift-ticket-social-btn zocial". $additionalClass . " " . strtolower($provider),
            )); ?>
    </div>
