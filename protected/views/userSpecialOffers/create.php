<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */

$this->breadcrumbs=array(
	'User Special Offers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserSpecialOffers', 'url'=>array('index')),
	array('label'=>'Manage UserSpecialOffers', 'url'=>array('admin')),
);
?>

<h1>Create UserSpecialOffers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>