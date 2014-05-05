<?php
class payLotteryInfoWidget extends CWidget
{
    public $paymentInfo;
    public $lotId;
    public $model;
    public $returnUrl;
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {
        if(!Yii::app()->user->isGuest()){
            $this->paymentInfo = Yii::app()->user->payInfo;
            if(!$this->paymentInfo){
                $this->paymentInfo = new UserPaymentInfo;
            }
            $this->renderContent();   
        }
    }
 
    protected function renderContent()
    {
        $this->render('payLotteryInfoView',
            array(
                'userPaymentInfo'=>$this->paymentInfo,
                'lottery'=>$this->model,
                'winner'=>$this->model->winner,
                'winnerTicket'=>$this->model->winnerTicket,
                'returnUrl'=>$this->returnUrl,
            )
        );
    }   
    
    protected function registerScripts()
    {
        $cs = Yii::app()->getClientScript();
        ob_start();
		?>
		$.showResponse = function(data){
                    data=$.parseJSON(data);
                    if(data.res){
                      $(".success-message").text(data.okMsg);
                      $(".success-block").show();
                      $(".error-message").text();
                      $(".error-block").hide();
                      if(data.isProfile == 1){
                      } else {
                        $("#reqPayBtn").attr("disabled","disabled");
                      }
                    } else {
                      $(".error-message").text(data.errMsg);
                      $(".error-block").show();
                      $(".success-message").text();
                      $(".success-block").hide();
                    }
                }
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
