<?php
class ticketsWidget extends CWidget
{
    public $ticket;
    public $tickets;
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {
        $this->renderContent();   
    }
 
    protected function renderContent()
    {
        $this->render('tickets',array('tickets'=>$this->tickets));
    }   
    
    protected function registerScripts()
    {
        $cs = Yii::app()->getClientScript();
        ob_start();
		?>
		jQuery('body').on('click','.set-gift',function(event) {
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
                        return false;
                   });
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
