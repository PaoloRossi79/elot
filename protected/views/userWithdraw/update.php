<?php
/* @var $this UserWithdrawController */
/* @var $model UserWithdraw */

$this->breadcrumbs=array(
	'User Withdraws'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserWithdraw', 'url'=>array('index')),
	array('label'=>'Create UserWithdraw', 'url'=>array('create')),
	array('label'=>'View UserWithdraw', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserWithdraw', 'url'=>array('admin')),
);
?>

<h1>Update UserWithdraw <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>