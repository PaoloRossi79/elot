<?php
class shareWidget extends CWidget
{
    public function init()
    {
        $this->registerScripts();
    }
 
    public function run()
    {
        if(!Yii::app()->user->isGuest()){
            
            $this->renderContent();   
        }
    }
 
    protected function renderContent()
    {
        $this->render('share',
            array(
                
            )
        );
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
