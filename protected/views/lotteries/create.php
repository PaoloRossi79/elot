<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */

$this->breadcrumbs=array(
	'Lotteries'=>array('index'),
	'Create',
);

?>

<h1><?php echo Yii::t("wonlot","Crea asta"); ?></h1>

<?php echo $this->renderPartial('_form', array('form' => $form)); ?>