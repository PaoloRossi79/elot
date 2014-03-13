<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">
    
        <button type="button" class="btn btn-primary"><?php echo CHtml::link('Special Offers', CController::createUrl('userSpecialOffers/view/'.$data->id));?></button>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('twitter_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->twitter_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cookie_hash')); ?>:</b>
	<?php echo CHtml::encode($data->cookie_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cookie_time_modified')); ?>:</b>
	<?php echo CHtml::encode($data->cookie_time_modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_agree_terms_conditions')); ?>:</b>
	<?php echo CHtml::encode($data->is_agree_terms_conditions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_agree_personaldata_management')); ?>:</b>
	<?php echo CHtml::encode($data->is_agree_personaldata_management); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_email_confirmed')); ?>:</b>
	<?php echo CHtml::encode($data->is_email_confirmed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signup_ip')); ?>:</b>
	<?php echo CHtml::encode($data->signup_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_ip')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_logged_in_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_logged_in_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('available_balance_amount')); ?>:</b>
	<?php echo CHtml::encode($data->available_balance_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dns')); ?>:</b>
	<?php echo CHtml::encode($data->dns); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wallet_value_bonus')); ?>:</b>
	<?php echo CHtml::encode($data->wallet_value_bonus); ?>
	<br />

	*/ ?>

</div>