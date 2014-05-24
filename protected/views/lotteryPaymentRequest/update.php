<?php
/* @var $this LotteryPaymentRequestController */
/* @var $model LotteryPaymentRequest */

$this->breadcrumbs=array(
	'Lottery Payment Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LotteryPaymentRequest', 'url'=>array('index')),
	array('label'=>'Create LotteryPaymentRequest', 'url'=>array('create')),
	array('label'=>'View LotteryPaymentRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LotteryPaymentRequest', 'url'=>array('admin')),
);
?>

<h1>Update LotteryPaymentRequest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>