<?php
class lotteryWidget extends CWidget
{
    public $dataProvider;
    public $tickets;
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {   
        if(!Yii::app()->user->isGuest){
            $this->dataProvider = Tickets::model()->getMyTicketsProvider();
            /*$this->dataProvider = new CActiveDataProvider('Lotteries');
            $this->dataProvider->setData($this->tickets);*/
            $t=$this->dataProvider->getData();
            $t2=$this->dataProvider->totalItemCount;
            $this->renderContent();   
        }
    }
 
    protected function renderContent()
    {
        $this->render('lotteryTable',array('tickets'=>$this->tickets));
    }   
    
    protected function registerScripts()
    {
        $cs = Yii::app()->getClientScript();
        ob_start();
		?>
		
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
