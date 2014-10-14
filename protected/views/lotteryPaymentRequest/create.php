<?php
/* @var $this LotteryPaymentRequestController */
/* @var $model LotteryPaymentRequest */

$this->breadcrumbs=array(
	'Lottery Payment Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LotteryPaymentRequest', 'url'=>array('index')),
	array('label'=>'Manage LotteryPaymentRequest', 'url'=>array('admin')),
);
?>

<h1>Create LotteryPaymentRequest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>