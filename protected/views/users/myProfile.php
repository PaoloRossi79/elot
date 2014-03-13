<?php
/* @var $this UserProfilesController */
/* @var $model UserProfiles */

$this->breadcrumbs=array(
	'User Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>
<h1><?php echo Yii::t('elot','My Profile'); ?></h1>

<?php 
    $this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Profilo'=>$this->renderPartial('_profile', array('model'=>$model),true),
        'Conto'=>$this->renderPartial('_buyCredit', array('model'=>$model),true),
        'Newsletter'=>$this->renderPartial('_newsletter', array('model'=>$model),true),
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
        'heightStyle'=>'content',
    ),
));
?>
