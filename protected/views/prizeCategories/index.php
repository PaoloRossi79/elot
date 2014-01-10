<?php
/* @var $this PrizeCategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prize Categories',
);

$this->menu=array(
	array('label'=>'Create PrizeCategories', 'url'=>array('create')),
	array('label'=>'Manage PrizeCategories', 'url'=>array('admin')),
);
?>

<h1>Prize Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
