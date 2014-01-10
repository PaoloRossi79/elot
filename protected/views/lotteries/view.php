<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */

$this->breadcrumbs=array(
	'Lotteries'=>array('index'),
	$model->name,
);

?>

<?php echo $this->renderPartial('_view', array('model' => $model)); ?>
