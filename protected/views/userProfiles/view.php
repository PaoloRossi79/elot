<?php
/* @var $this UserProfilesController */
/* @var $model UserProfiles */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->id,
);

?>

<h1><?php echo Yii::t('elot','My Profile'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
