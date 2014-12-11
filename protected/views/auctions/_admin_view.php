<?php
/* @var $this AuctionsController */
/* @var $data Auctions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lottery_type')); ?>:</b>
	<?php echo CHtml::encode(Yii::app()->params['lotteryTypes'][$data->lottery_type]['name']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_desc')); ?>:</b>
	<?php echo $data->prize_desc; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_category')); ?>:</b>
	<?php echo CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($data->prize_category)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_conditions')); ?>:</b>
	<?php echo CHtml::encode($data->prize_conditions); ?>
	<br />
 
	<b><?php echo CHtml::encode($data->getAttributeLabel('prize_shipping')); ?>:</b>
	<?php echo CHtml::encode($data->prize_shipping); ?>
	<br />

	<b><?php // echo CHtml::encode($data->getAttributeLabel('prize_shipping_charges')); ?>:</b>
	<?php // echo CHtml::encode($data->prize_shipping_charges); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->min_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_ticket')); ?>:</b>
	<?php echo CHtml::encode($data->max_ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_value')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lottery_start_date')); ?>:</b>
	<?php echo CHtml::encode($data->lottery_start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lottery_draw_date')); ?>:</b>
	<?php echo CHtml::encode($data->lottery_draw_date); ?>
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

</div>