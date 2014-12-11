<?php
/* @var $this AuctionsController */
/* @var $model Auctions */

$this->breadcrumbs=array(
	'Auctions'=>array('index'),
	'Create',
);

?>

<h1><?php echo Yii::t("wonlot","Crea asta"); ?></h1>

<?php echo $this->renderPartial('_form', array('form' => $form)); ?>