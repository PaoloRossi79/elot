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

<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); 

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',          // display the 'title' attribute
        'serial_number',  // display the 'name' attribute of the 'category' relation
        'lottery.name',  // display the 'name' attribute of the 'category' relation
//        'content:html',   // display the 'content' attribute as purified HTML
        array(            // display 'create_time' using an expression
            'name'=>'lottery.status',
//            'value'=>'$data->lottery->getStatusText()',
            'value'=>'Lotteries::model()->getStatusText($data->lottery->status)',
        ),
        array(            // display 'create_time' using an expression
            'name'=>'lottery.prize_category',
            'value'=>'PrizeCategories::model()->getPrizeCatNameById($data->lottery->prize_category)',
        ),
//        array(            // display 'author.username' using an expression
//            'name'=>'authorName',
//            'value'=>'$data->author->username',
//        ),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
            'template' => '{view}',
        ),
    ),
));
?>
