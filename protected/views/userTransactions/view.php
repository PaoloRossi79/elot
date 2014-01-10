<?php
/* @var $this UserTransactionsController */
/* @var $model UserTransactions */

$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserTransactions', 'url'=>array('index')),
	array('label'=>'Create UserTransactions', 'url'=>array('create')),
	array('label'=>'Update UserTransactions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserTransactions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserTransactions', 'url'=>array('admin')),
);
?>

<h1>View UserTransactions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'transaction_type',
		'transaction_ref_id',
		'value',
		'is_confirmed',
		'promotion_id',
		'created',
		'modified',
		'last_modified_by',
	),
)); ?>
