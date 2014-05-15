<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */
if($user){
    $model->user_id = $user->id;
    $this->renderPartial('_form', array('model'=>$model,'user'=>$user)); 
} else { ?>
    <h2><span class="text-danger"><?php echo Yii::t('wonlot','Errore: nessun utente selezionato'); ?></span></h2>
<?php } ?>