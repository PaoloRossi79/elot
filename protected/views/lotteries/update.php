<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */

$this->breadcrumbs=array(
	'Lotteries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<?php echo $this->renderPartial('_form', array('form' => $form, 'model' => $model)); ?>