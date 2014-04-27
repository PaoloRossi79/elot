<?php
class listLotteryWidget extends CWidget
{
    public $lotController;
    public $model;
    public function run()
    {
        $this->lotController = Yii::app()->createController('lotteries');
        $this->lotController = $this->lotController[0];
        
        if(!Yii::app()->user->isGuest){
//            $this->lotController->ticketTotals=Tickets::model()->getMyTicketsByLottery($this->model->id);
        }
//        $this->render('main-lot',array('model'=>Lotteries::model()->findByPk($this->model->id)));
        $this->render('main-lot');
    }
}
?>
