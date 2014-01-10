<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subscriptions', 'url'=>array('index')),
	array('label'=>'Create Subscriptions', 'url'=>array('create')),
	array('label'=>'View Subscriptions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subscriptions', 'url'=>array('admin')),
);
?>

<h1>Update Subscriptions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>