<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */

$this->breadcrumbs=array(
	'User Special Offers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserSpecialOffers', 'url'=>array('index')),
	array('label'=>'Create UserSpecialOffers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-special-offers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Special Offers</h1>

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
	'id'=>'user-special-offers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'offer_on',
		'offer_value',
		'comment',
		'start_date',
		/*
		'end_date',
		'times_remaining',
		'created',
		'modified',
		'last_modified_by',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
