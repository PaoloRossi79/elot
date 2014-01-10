<?php
/* @var $this PrizeCategoriesController */
/* @var $model PrizeCategories */

$this->breadcrumbs=array(
	'Prize Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PrizeCategories', 'url'=>array('index')),
	array('label'=>'Manage PrizeCategories', 'url'=>array('admin')),
);
?>

<h1>Create PrizeCategories</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>