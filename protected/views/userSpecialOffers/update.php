<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */

$this->breadcrumbs=array(
	'User Special Offers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserSpecialOffers', 'url'=>array('index')),
	array('label'=>'Create UserSpecialOffers', 'url'=>array('create')),
	array('label'=>'View UserSpecialOffers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserSpecialOffers', 'url'=>array('admin')),
);
?>

<h1>Update UserSpecialOffers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>