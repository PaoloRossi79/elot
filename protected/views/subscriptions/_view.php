<?php
/* @var $this SubscriptionsController */
/* @var $data Subscriptions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nl_type')); ?>:</b>
	<?php echo CHtml::encode($data->nl_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nl_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->nl_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_modified_by')); ?>:</b>
	<?php echo CHtml::encode($data->last_modified_by); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_ip')); ?>:</b>
	<?php echo CHtml::encode($data->sub_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sub_dns')); ?>:</b>
	<?php echo CHtml::encode($data->sub_dns); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('term_cond')); ?>:</b>
	<?php echo CHtml::encode($data->term_cond); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privacy_ok')); ?>:</b>
	<?php echo CHtml::encode($data->privacy_ok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_msg_sent')); ?>:</b>
	<?php echo CHtml::encode($data->n_msg_sent); ?>
	<br />

	*/ ?>

</div>