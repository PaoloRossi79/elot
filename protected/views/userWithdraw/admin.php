<?php
/* @var $this UserWithdrawController */
/* @var $model UserWithdraw */

$this->breadcrumbs=array(
	'User Withdraws'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserWithdraw', 'url'=>array('index')),
	array('label'=>'Create UserWithdraw', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-withdraw-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Withdraws</h1>

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
	'id'=>'user-withdraw-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
                    'name'=>'user',
                    'type'=>'raw',
                    'value'=>'$this->grid->controller->widget("userBoxWidget", array("model"=>$data->user), true);',
                ),
		'value',
		'created',
		array(
                    'name'=>'status',
                    'type'=>'raw',
                    'value'=>'Yii::app()->params["payStatusConst"][$data->status]',
                ),
		array(
                    'name'=>'paid_by',
                    'type'=>'raw',
                    'value'=>'$this->grid->controller->widget("userBoxWidget", array("model"=>$data->paidUser), true);',
                ),
		'paid_on',		
		'paid_ref',		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
