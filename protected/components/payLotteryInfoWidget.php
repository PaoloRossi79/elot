<?php
class payLotteryInfoWidget extends CWidget
{
    public $paymentInfo;
    public $userWithdraw;
    public $lotId;
    public $model;
    public $returnUrl;
    public $type;
    public $isComplete = false;
    public $userCredit;
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {
        if(!Yii::app()->user->isGuest()){
            $this->paymentInfo = Yii::app()->user->payInfo;
            $this->userWithdraw = new UserWithdraw;
            $this->userCredit = Yii::app()->user->walletValue;
            if(!$this->paymentInfo){
                $this->paymentInfo = new UserPaymentInfo;
            } else {
                if(($userInfoModel->vat || $userInfoModel->fiscal_number) && ($userInfoModel->iban || $userInfoModel->paypal_account)){
                    $this->isComplete = true;
                }
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
                'type'=>$this->type,
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
                      /*if(data.isProfile == 1){
                      } else {
                        $("#reqPayBtn").attr("disabled","disabled");
                      }*/
                      $('#reqPayBtn').removeAttr('disabled');
                      $('.draw-block').fadeIn();
                    } else {
                      $(".error-message").text(data.errMsg);
                      $(".error-block").show();
                      $(".success-message").text();
                      $(".success-block").hide();
                      //$('#reqPayBtn').attr('disabled','disabled');
                    }
                }
                <?php
        $cs->registerScript(__CLASS__, ob_get_clean());
    }
}
?>
