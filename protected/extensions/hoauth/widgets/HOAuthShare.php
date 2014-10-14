<?php
/**
 * HOAuth provides widget with buttons for login with social networs 
 * that enabled in HybridAuth config
 * 
 * @uses CWidget
 * @version 1.2.4
 * @copyright Copyright &copy; 2013 Sviatoslav Danylenko
 * @author Sviatoslav Danylenko <dev@udf.su> 
 * @license MIT ({@link http://opensource.org/licenses/MIT})
 * @link https://github.com/SleepWalker/hoauth
 */

/**
 * NOTE: If you want to change the order of button it is better to change this order in HybridAuth config.php file
 */
class HOAuthShare extends CWidget
{
	/**
	 * @var string $route id of module and controller (eg. module/controller) for wich to generate oauth urls
	 */
	public $route = false;

	/**
	 * @var boolean $onlyIcons the flag that displays social buttons as icons
	 */
	public $onlyIcons = false;

	/**
	 * @var integer $popupWidth the width of the popup window
	 */
	public $popupWidth = 480;

	/**
	 * @var integer $popupHeight the height of the popup window
	 */
	public $popupHeight = 680;

	public function init()
	{
		if(!$this->route)
			$this->route = $this->controller->module ? $this->controller->module->id . '/' . $this->controller->id : $this->controller->id;
		
		require_once(dirname(__FILE__).'/../models/UserOAuth.php');
                require_once(dirname(__FILE__).'/../HOAuthShareAction.php');
		$this->registerScripts();
	}

	public function run()
	{
		$config = UserOAuth::getConfig();
		echo CHtml::openTag('div', array(
			'id' => 'hoauthShareWidget' . $this->id,
			'class' => 'hoauthShareWidget social-share-container',
			));
                
		/*foreach($config['providers'] as $provider => $settings){
			if($settings['enabled']){
				$this->render('friends', array(
					'provider' => $provider,
				));
                        }
                }*/
		echo '<div class="clearfix"></div>';
		echo CHtml::closeTag('div');
	}

	protected function registerScripts()
	{
		$assetsUrl = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets',false,-1,YII_DEBUG);
                $cs = Yii::app()->getClientScript();
//		$cs->registerCoreScript('jquery'); 
//                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $cs->registerCssFile($assetsUrl.'/css/zocial.css');
                $config = UserOAuth::getConfig();
    ob_start();
		?>
   		  
<?php
    $cs->registerScript(__CLASS__, ob_get_clean());
	}
}
