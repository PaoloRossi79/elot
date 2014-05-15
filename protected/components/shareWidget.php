<?php
class shareWidget extends CWidget
{
    public $model;
    public $link;
    
    public function init()
    {
        Yii::import('ext.hoauth.models.UserOAuth');
        $this->registerScripts();
    }
 
    public function run()
    {
        if(!Yii::app()->user->isGuest()){
            if($this->model){
                $this->link = Yii::app()->createAbsoluteUrl('/'.  lcfirst(get_class($this->model)).'/view/'.$this->model->id);
                $this->renderContent();   
            }
        }
    }
 
    protected function renderContent()
    {
        $this->render('share',
            array(
                'config' => UserOAuth::getConfig(),
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
