<?php
/* @var $this LotteriesController */
/* @var $model Lotteries */

$this->breadcrumbs=array(
	'Lotteries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lotteries', 'url'=>array('index')),
	array('label'=>'Create Lotteries', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lotteries-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lotteries</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lotteries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'lottery_type',
		'prize_desc',
		'prize_category',
		/*
		'prize_conditions',
		'prize_shipping',
		'prize_shipping_charges',
		'min_ticket',
		'max_ticket',
		'ticket_value',
		'lottery_start_date',
		'lottery_draw_date',
		'created',
		'modified',
		'last_modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
