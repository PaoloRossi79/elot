<?php
/* @var $this LotteryPaymentRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lottery Payment Requests',
);

$this->menu=array(
	array('label'=>'Create LotteryPaymentRequest', 'url'=>array('create')),
	array('label'=>'Manage LotteryPaymentRequest', 'url'=>array('admin')),
);
?>

<h1>Lottery Payment Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
