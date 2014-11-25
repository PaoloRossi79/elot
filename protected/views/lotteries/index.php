<div class="left">
    <h1><?php echo Yii::t("wonlot","Aste"); ?></h1>
    <?php 
    if($viewData['showStatus']){
    //   $h1.=" <h3>(".CHtml::encode(Yii::app()->params['lotteryStatusConst'][$viewData['showStatus']]).")</h3>"; 
       $h1.= "<h3>".Yii::t("wonlot","Stato:")." ".CHtml::encode(Yii::t("wonlot",$viewData['showStatus']))."</h3>"; 
    }
    if($viewData['showCat']){
       $h1.= "<h3>".Yii::t("wonlot","Categoria:")." ".CHtml::encode(Yii::t("wonlot",PrizeCategories::model()->getPrizeCatNameById($viewData['showCat'])))."</h3>"; 
    }
    echo $h1; ?>
</div>
<div class="right">
    <?php if(!Yii::app()->user->isGuest){
        echo CHtml::link(Yii::t("wonlot","Nuova asta"),CController::createUrl('lotteries/create'),array('class'=>'btn btn-success')); 
    }
    ?>
</div>

    <?php
    $this->widget('ext.isotope.Isotope',array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'lot-box',
        'viewData'=>$viewData,
        'itemSelectorClass'=>'lot-box-item',
        'options'=>array( // options for the isotope jquery
            'layoutMode'=>'masonry',
            'columnWidth'=>240,
            'containerStyle' => array(
                'position' => 'relative', 
                'overflow' => 'hidden', 
            ),
            'animationEngine'=>'jquery',
            'animationOptions'=>array(
                    'duration'=>300,
            ),
            'resizesContainer' => true,
        ), 
        'infiniteScroll'=>true, // default to true
        /*'infiniteCallback'=>'
            \$(".lot-box-int").mouseenter(
                function(){
                  var hiddenDiv = \$(this).parent().children(".lot-box-hover");
                  hiddenDiv.filter(":not(:animated)").fadeIn();
                // This only fires if the row is not undergoing an animation when you mouseover it
                }
             );
             \$(".lot-box-hover).mouseleave(
                 function(){
                  \$(this).fadeOut();
                // This only fires if the row is not undergoing an animation when you mouseover it
                }
             );
        ',*/
        'infiniteOptions'=>array(
            'loading' => array(
                'msgText' => 'Caricamento ... ',
                'finishedMsg' => 'Tutte le lotterie sono state caricate!',
            )
        ), // javascript options for infinite scroller
        'id'=>'lot-isotope-1',
    )); ?>