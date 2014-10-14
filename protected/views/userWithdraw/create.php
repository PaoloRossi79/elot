<?php
/* @var $this UserWithdrawController */
/* @var $model UserWithdraw */

$this->breadcrumbs=array(
	'User Withdraws'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserWithdraw', 'url'=>array('index')),
	array('label'=>'Manage UserWithdraw', 'url'=>array('admin')),
);
?>

<h1>Create UserWithdraw</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>