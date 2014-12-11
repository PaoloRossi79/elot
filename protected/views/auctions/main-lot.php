<?php 
    $mainLotDp = Auctions::getMainAuctions(); 
    $this->widget('ext.isotope.Isotope',array(
        'dataProvider'=>$mainLotDp,
        'itemView'=>'/auctions/lot-box',
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
             \$(".lot-box-hover").mouseleave(
                 function(){
                  \$(this).fadeOut();
                // This only fires if the row is not undergoing an animation when you mouseover it
                }
             );
        ',*/
        'infiniteOptions'=>array(
            'loading' => array(
                'msgText' => 'Caricamento ... ',
                'finishedMsg' => 'Tutte le aste sono state caricate!',
            )
        ), // javascript options for infinite scroller
        'id'=>'lot-isotope-2',
    ));
?>