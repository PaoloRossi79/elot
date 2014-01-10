<?php
/* @var $this UserProfilesController */
/* @var $model UserProfiles */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<?php 
    if($model->ext_source > 0){
        echo CHtml::image($model->profile->img, "User Avatar", array("class"=>"user-avatar"));
    } else {
        echo CHtml::image("/images/userProfiles/".Yii::app()->user->id."/mediumThumb/".$model->profile->img, "User Avatar", array("class"=>"user-avatar"));
    } ?>

<h1><?php echo Yii::t('elot','My Profile'); ?></h1>
<?php 
    /*foreach($this->getImageList() as $filename){
        echo CHtml::image($filename, "User Avatar", array("class"=>"user-avatar")); 
    }*/
?>

<?php $this->renderPartial('_profile', array('model'=>$model)); ?>