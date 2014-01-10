<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */

$this->breadcrumbs=array(
	'Lotteries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Edit Lotteries <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('form' => $form)); ?>