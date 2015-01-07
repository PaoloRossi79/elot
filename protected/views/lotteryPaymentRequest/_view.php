
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lottery_id')); ?>:</b>
	<?php echo CHtml::encode($data->lottery_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->from_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sent_date')); ?>:</b>
	<?php echo CHtml::encode($data->sent_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_completed')); ?>:</b>
	<?php echo CHtml::encode($data->is_completed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complete_date')); ?>:</b>
	<?php echo CHtml::encode($data->complete_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complete_by')); ?>:</b>
	<?php echo CHtml::encode($data->complete_by); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('complete_ref')); ?>:</b>
	<?php echo CHtml::encode($data->complete_ref); ?>
	<br />

	*/ ?>

</div>