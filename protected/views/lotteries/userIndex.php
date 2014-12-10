<div class="left">
<?php 
$h1="<h1>Aste</h1>";
if($viewData['showStatus']){
//   $h1.=" <h3>(".CHtml::encode(Yii::app()->params['lotteryStatusConst'][$viewData['showStatus']]).")</h3>"; 
   $h1.=" <h3>Status: ".CHtml::encode($viewData['showStatus'])."</h3>"; 
}
if($viewData['showCat']){
   $h1.=" <h3>Categorie: ".CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($viewData['showCat']))."</h3>"; 
}
echo $h1; ?>
    
<div class="right">
    <?php if(!Yii::app()->user->isGuest){
        echo CHtml::link(Yii::t("wonlot","Nuova asta"),CController::createUrl('lotteries/create'),array('class'=>'btn btn-success')); 
    } ?>
</div>

<div class="alert alert-error void-alert" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong id="void-alert-strong"></strong>
</div>
<?php

    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$dataProvider,
        //'filter' => $this->filterModel,
        'id'=>'mylot-grid',
//        'itemView'=>'/lotteries/my-lot-box',
        'enablePagination'=>true,
        'enableSorting'=>true,
        'columns'=>array(
            'name',          // display the 'title' attribute
            'category.category_name',  // display the 'name' attribute of the 'category' relation
            'prize_desc:html',   // display the 'content' attribute as purified HTML
            array(            // display 'create_time' using an expression
                'name'=>'status',
//                'value'=>'date("M j, Y", $data->lottery_start_date)',
                'value'=>array($dataProvider->model,'getStatusText'), 
                'filter'=>CHtml::dropDownList('Provider[onoff]', '',  
                    array(
                        ''=>'All',
                        '1'=>'On',
                        '0'=>'Off',
                    )
                ),
            ),
            array(            // display 'create_time' using an expression
                'name'=>'lottery_start_date',
//                'value'=>'date("M j, Y", $data->lottery_start_date)',
                'value'=>'$data->lottery_start_date',
            ),
            array(            // display 'create_time' using an expression
                'name'=>'lottery_draw_date',
                'value'=>'$data->lottery_draw_date',
            ),
            array(            // display 'create_time' using an expression
                'name'=>'prize_img',
//                'type'=>'image',
                'type'=>'html',
                'value'=>'CHtml::image(Controller::getImageUrl($data,"smallSquaredThumb"),"Foto Premio")',
                'filter'=>false,
            ),
            
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'template' => '{view}{update}{clone}{void}{delete}',
                'buttons'=>array
                (
                    'view' => array
                    (
                        'label'=>'<span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-search">Vedi</i></span>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createUrl("lotteries/view", array("id"=>$data->id))',
                    ),
                    'update' => array
                    (
                        'label'=>'<span class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit">Modifica</i></span>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createUrl("lotteries/update", array("id"=>$data->id))',
                        'visible'=>'$data->status == 1 || $data->status == 2 || $data->status == 3',
                    ),
                    'clone' => array
                    (
                        'label'=>'<span class="btn btn-info btn-xs"><i class="glyphicon glyphicon-plus">Clona</i></span>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createUrl("lotteries/clone", array("id"=>$data->id))',
                    ),
                    'void' => array
                    (
                        'label'=>'<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove">Annulla</i></span>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createUrl("lotteries/void", array("id"=>$data->id))',
                        'visible'=>'$data->status == 3',
                        'options' => array( 
                            'ajax' => array(
                                'type' => 'post', 
                                'data' => array('isAjax'=>true),
                                'url'=>'js:$(this).attr("href")', 
                                'success' => 'js:function(data) { '
                                . "alert(data);"
                                . "if(data != 1){"
                                . "$('#void-alert-strong').text(data);"
                                . "$('.void-alert').removeClass('alert-success');"
                                . "$('.void-alert').addClass('alert-error');"
                                . "$('.void-alert').fadeIn();"
                                . "} else {"
                                . "$('.void-alert').removeClass('alert-success');"
                                . "$('.void-alert').addClass('alert-error');"
                                . "$('.void-alert').fadeOut();"
                                . "}"
                                . '$.fn.yiiGridView.update("my-grid");'
                                . '}'
                            ),
                            'confirm'=>Yii::t('wonlot','Sei sicuro di voler annullare questa Asta?'),
                        )
                    ),
                    'delete' => array
                    (
                        'label'=>'<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove">Elimina</i></span>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createUrl("lotteries/delete", array("id"=>$data->id))',
                        'visible'=>'$data->status <= 2',
                    ),
                ),
            ),
        ),
    ));
    ?>

    <?php
//    

    ?>
</div>