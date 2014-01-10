<?php
/* @var $this TicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tickets',
);
?>
<?php 
$h1="<h1>Tickets</h1>";
if($viewData['showStatus']){
   $h1.="<h3>(".CHtml::encode($viewData['status']).")</h3>"; 
}
echo $h1;
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
