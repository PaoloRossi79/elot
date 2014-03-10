<?php 
$h1="<h1>Lotteries</h1>";
if($viewData['showStatus']){
//   $h1.=" <h3>(".CHtml::encode(Yii::app()->params['lotteryStatusConst'][$viewData['showStatus']]).")</h3>"; 
   $h1.=" <h3>Status: ".CHtml::encode($viewData['showStatus'])."</h3>"; 
}
if($viewData['showCat']){
   $h1.=" <h3>Category: ".CHtml::encode(PrizeCategories::model()->getPrizeCatNameById($viewData['showCat']))."</h3>"; 
}
echo $h1;
if(!Yii::app()->user->isGuest){
    echo CHtml::link("New Lottery",CController::createUrl('lotteries/create'),array('class'=>'btn')); 
}
?>

<!--<div class="btn-group">
  <button type="button" class="btn btn-danger">Action</button>
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <?php $cat=new PrizeCategories();
        echo CHtml::activeCheckboxList(
            $cat, 'id', 
            CHtml::listData(PrizeCategories::model()->findAll(), 'id', 'category_name'),
            array('template'=>'<li>{input} {label}</li>',)
    );?>
  </ul>
</div>-->
<?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'/lotteries/lot-box',
        'enablePagination'=>false,
    ));
    ?>

    <?php
    /*$this->widget('ext.isotope.Isotope',array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'lot-box',
        'viewData'=>$viewData,
        'itemSelectorClass'=>'isotope-item',
        'options'=>array( // options for the isotope jquery
            'layoutMode'=>'masonry',
            'containerStyle' => array(
                'position' => 'relative', 'overflow' => 'hidden'
            ),
            'animationEngine'=>'jquery',
            'animationOptions'=>array(
                    'duration'=>300,
            ),
        ), 
        'infiniteScroll'=>true, // default to true
        'infiniteOptions'=>array(), // javascript options for infinite scroller
        'id'=>'wall',
    ));*/
     ?>
     
