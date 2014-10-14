<?php
class lotteryBoxWidget extends CWidget
{
    public $model;
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {   
        if(!Yii::app()->user->isGuest){
            $this->renderContent();   
        }
    }
 
    protected function renderContent()
    {
        $this->render('lotteryBox',array('data'=>$this->model));
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
