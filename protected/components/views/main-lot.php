<?php 
    $mainLotDp = Lotteries::getMainLotteries(); 
    $this->widget('ext.isotope.Isotope',array(
        'dataProvider'=>$mainLotDp,
        'itemView'=>'/lotteries/lot-box',
        'itemSelectorClass'=>'lot-box-item',
        'options'=>array( // options for the isotope jquery
            'layoutMode'=>'masonry',
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
        'infiniteOptions'=>array(
            'loading' => array(
                'msgText' => 'Caricamento ... ',
                'finishedMsg' => 'Tutte le lotterie sono state caricate!',
            )
        ), // javascript options for infinite scroller
        'id'=>'lot-isotope-2',
    ));
?>