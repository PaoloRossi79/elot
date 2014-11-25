<?php
class listLotteryWidget extends CWidget
{
    public $lotController;
    public $model;
    public function run()
    {
        $this->lotController = Yii::app()->createController('lotteries');
        $this->lotController = $this->lotController[0];
        
        $this->render('main-lot');
    }
}
?>
