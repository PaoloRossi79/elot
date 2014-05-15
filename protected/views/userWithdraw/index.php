<?php
/* @var $this UserWithdrawController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Withdraws',
);

$this->menu=array(
	array('label'=>'Create UserWithdraw', 'url'=>array('create')),
	array('label'=>'Manage UserWithdraw', 'url'=>array('admin')),
);
?>

<h1>User Withdraws</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
