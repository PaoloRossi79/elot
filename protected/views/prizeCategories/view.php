<?php
/* @var $this PrizeCategoriesController */
/* @var $model PrizeCategories */

$this->breadcrumbs=array(
	'Prize Categories'=>array('index'),
	$model->id,
);

?>

<h1>Lotteries - </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/lotteries/_view',
)); ?>
