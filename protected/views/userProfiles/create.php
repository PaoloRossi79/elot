<?php
/* @var $this UserProfilesController */
/* @var $model UserProfiles */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserProfiles', 'url'=>array('index')),
	array('label'=>'Manage UserProfiles', 'url'=>array('admin')),
);
?>

<h1>Create UserProfiles</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>