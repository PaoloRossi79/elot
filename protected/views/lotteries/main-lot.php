<?php 
    $mainLotDp = Lotteries::getMainLotteries(); 
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$mainLotDp,
        'itemView'=>'/lotteries/lot-box',   // refers to the partial view named '_post'
    ));
?>