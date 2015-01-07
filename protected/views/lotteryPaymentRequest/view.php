<?php

$this->breadcrumbs=array(
	'Lottery Payment Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LotteryPaymentRequest', 'url'=>array('index')),
	array('label'=>'Create LotteryPaymentRequest', 'url'=>array('create')),
	array('label'=>'Update LotteryPaymentRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LotteryPaymentRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LotteryPaymentRequest', 'url'=>array('admin')),
);
?>

<h1>View LotteryPaymentRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'lottery_id',
		'from_user_id',
		'sent_date',
		'is_completed',
		'complete_date',
		'complete_by',
		'complete_ref',
	),
)); ?>
