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
    $panel2=CHtml::ajaxButton ("Buy Credit",
            CController::createUrl('users/buyCredit'), 
            array('update' => '#buyCreditTarget',
                    'type' => 'POST', 
                    'data'=>'js:$("#userWallet-form").serialize()',
            ));
    $panel2.=$this->renderPartial('_buyCredit', array('model'=>$model),true);
    $panel3=CHtml::ajaxButton ("Save",
            CController::createUrl('users/editNewsletter'), 
            array('update' => '#newsForm',
                    'type' => 'POST', 
                    'data'=>'js:$("#newsletter-form").serialize()',
            ));
    $panel3.=$this->renderPartial('_newsletter', array('model'=>$model),true);
    $this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
        'Profilo'=>$this->renderPartial('_profile', array('model'=>$model),true),
//        'Conto'=>$this->renderPartial('_buyCredit', array('model'=>$model),true),
//        'Newsletter'=>$this->renderPartial('_newsletter', array('model'=>$model),true),
        'Conto'=>$panel2,
        'Newsletter'=>$panel3,
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
        'heightStyle'=>'content',
    ),
));
?>
