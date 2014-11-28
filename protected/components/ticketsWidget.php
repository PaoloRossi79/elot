<?php
class ticketsWidget extends CWidget
{
    public $ticket;
    public $tickets;
    public $userId;
    public $lotId;
    
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {
        $this->userId = Yii::app()->user->id;
        $this->renderContent();   
    }
 
    protected function renderContent()
    {
        $myTickets = array();
        $toGiftTickets = array();
        if($this->tickets){
            foreach($this->tickets as $t){
                if($t->is_gift == 1 && $t->gift_from_id == Yii::app()->user->id){
                    $toGiftTickets[] = $t;
                } else {
                    $myTickets[] = $t;
                }
            }
            
        } 
        $this->render('tickets',array(
            'lotId'=>$this->lotId,
            'myTickets'=>$myTickets,
            'toGiftTickets'=>$toGiftTickets,
        ));
    }   
    
    protected function registerScripts()
    {
        $cs = Yii::app()->getClientScript();
        ob_start();
		?>
		$('.ticket-list-btn').click(function(event){
                    $('#myTickets'+this.id).click();
                    if(!$("#ticket-lot-"+this.id).is(":visible")){
                         $(".ticket-block").fadeOut();
                         $("#ticket-lot-"+this.id).fadeIn();
                    }
                });
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
