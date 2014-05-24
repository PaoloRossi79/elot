<?php
/* @var $this LotteryPaymentRequestController */
/* @var $model LotteryPaymentRequest */

$this->breadcrumbs=array(
	'Lottery Payment Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List LotteryPaymentRequest', 'url'=>array('index')),
	array('label'=>'Create LotteryPaymentRequest', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lottery-payment-request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lottery Payment Requests</h1>

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
	'id'=>'lottery-payment-request-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name'=>'lottery',
                    'type'=>'raw',
                    'value'=>'$this->grid->controller->widget("lotteryBoxWidget", array("model"=>$data->lottery), true);',
                ),
                array(
                    'name'=>'user',
                    'type'=>'raw',
                    'value'=>'$this->grid->controller->widget("userBoxWidget", array("model"=>$data->user), true);',
                ),
		'sent_date',
		'is_completed',
		'complete_date',
                array(
                    'name'=>'completeUser',
                    'type'=>'raw',
                    'value'=>'$this->grid->controller->widget("userBoxWidget", array("model"=>$data->completeUser), true);',
                ),
		
		'complete_ref',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
