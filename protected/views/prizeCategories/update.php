<?php
/* @var $this PrizeCategoriesController */
/* @var $model PrizeCategories */

$this->breadcrumbs=array(
	'Prize Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PrizeCategories', 'url'=>array('index')),
	array('label'=>'Create PrizeCategories', 'url'=>array('create')),
	array('label'=>'View PrizeCategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PrizeCategories', 'url'=>array('admin')),
);
?>

<h1>Update PrizeCategories <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>