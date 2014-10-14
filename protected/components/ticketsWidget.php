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
		/*jQuery('body').on('click','.set-gift',function(event) {
                        $("input[name=giftBtn]").removeAttr("disabled");
                        $("#ticketIdForGift").val($(this).attr("id"));
                        $(".gift-box").slideDown(); 
                        $("#labelTicketNumber").text($(this).parent().children().first().text()); 
                        $('#buy-modal').modal('hide');
                        $('#gift-modal').modal('show');
                        $('#gift-email-form').get(0).reset();
                        $("#emailFormGroup").removeClass("has-error");
                        $("#emailFormGroup").removeClass("has-success");
                        $("#emailSuccessText").hide();
                        $("#emailErrorText").hide();
                        $("#giftBtn").removeAttr("disabled");
                        $(".feedShare").removeAttr("disabled");
                        return false;
                   });*/
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
