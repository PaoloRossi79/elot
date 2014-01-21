<?php
/* @var $this UserSpecialOffersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Special Offers',
);

$this->menu=array(
	array('label'=>'Create UserSpecialOffers', 'url'=>array('create')),
	array('label'=>'Manage UserSpecialOffers', 'url'=>array('admin')),
);
?>

<h1>User Special Offers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
