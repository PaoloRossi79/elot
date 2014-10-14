<?php
/* @var $this UserWithdrawController */
/* @var $model UserWithdraw */

$this->breadcrumbs=array(
	'User Withdraws'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserWithdraw', 'url'=>array('index')),
	array('label'=>'Create UserWithdraw', 'url'=>array('create')),
	array('label'=>'Update UserWithdraw', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserWithdraw', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserWithdraw', 'url'=>array('admin')),
);
?>

<h1>View UserWithdraw #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'value',
		'created',
		'modified',
		'last_modified_by',
		'status',
		'paid_by',
		'paid_on',
	),
)); ?>
