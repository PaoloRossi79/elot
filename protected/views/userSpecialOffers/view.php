<?php
/* @var $this UserSpecialOffersController */
/* @var $model UserSpecialOffers */

$this->breadcrumbs=array(
	'User Special Offers'=>array('index'),
	$model->id,
);
?>

<h1>View UserSpecialOffers </h1>

<?php 

$this->widget(
    'bootstrap.widgets.TbExtendedGridView',
    array(
//        'filter' => $person,
        'fixedHeader' => true,
        'type' => 'striped bordered',
        'headerOffset' => 40,
        // 40px is the height of the main navigation at bootstrap
        'dataProvider' => $dataProvider,
        'template' => "{items}",
        'columns'=>array(
        array(            // display 'create_time' using an expression
            'name'=>'offer_on',
            'value'=>'Yii::app()->params["specialOffersType"][$data->offer_on]["name"]',
        ),
        array(            // display 'create_time' using an expression
            'name'=>'offer_value',
            'value'=>'$data->getTextOfferValue()',
        ),
        'times_remaining',
        array(            // display 'create_time' using an expression
            'name'=>'start_date',
            'value'=>'($data->start_date) ? $data->start_date : ""',
        ),
        array(            // display 'create_time' using an expression
            'name'=>'end_date',
            'value'=>'($data->end_date) ? $data->end_date : ""',
        ),
        'comment',
//        array(            // display 'author.username' using an expression
//            'name'=>'authorName',
//            'value'=>'$data->author->username',
//        ),
        array(            // display a column with "view", "update" and "delete" buttons
            'class'=>'CButtonColumn',
        ),
    ),
    )
);
?>

<?php $this->renderPartial('_form',array('userId' => $userId, 'model' => $model));
