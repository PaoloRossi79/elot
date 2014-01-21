<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'modified',
		'user_type_id',
		'email',
		'password',
		
		'cookie_hash',
		'cookie_time_modified',
		'is_agree_terms_conditions',
		'is_agree_personaldata_management',
		'is_active',
		'is_email_confirmed',
		'signup_ip',
		'last_login_ip',
		'last_logged_in_time',
		'available_balance_amount',
		'dns',
		'wallet_value_bonus',
	),
)); ?>
