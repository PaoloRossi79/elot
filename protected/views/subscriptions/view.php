<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Subscriptions', 'url'=>array('index')),
	array('label'=>'Create Subscriptions', 'url'=>array('create')),
	array('label'=>'Update Subscriptions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subscriptions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subscriptions', 'url'=>array('admin')),
);
?>

<h1>View Subscriptions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nl_type',
		'nl_type_id',
		'user_id',
		'created',
		'modified',
		'last_modified_by',
		'is_active',
		'sub_ip',
		'sub_dns',
		'term_cond',
		'privacy_ok',
		'n_msg_sent',
	),
)); ?>
