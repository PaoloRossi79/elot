<?php
/* @var $this AuctionsController */
/* @var $model Auctions */

$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	$model->name,
);

?>

<?php echo $this->renderPartial('_view', array('model' => $model)); ?>
