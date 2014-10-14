<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subscriptions', 'url'=>array('index')),
	array('label'=>'Manage Subscriptions', 'url'=>array('admin')),
);
?>

<h1>Create Subscriptions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>