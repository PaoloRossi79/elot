<?php
/**
 * HOAuthShare - this the main class in hoauth extension.
 * 
 * @uses CAction
 * @version 1.2.4
 * @copyright Copyright &copy; 2013 Sviatoslav Danylenko
 * @author Sviatoslav Danylenko <dev@udf.su> 
 * @license MIT ({@link http://opensource.org/licenses/MIT})
 * @link https://github.com/SleepWalker/hoauth
 */

/**
 * HOAuthShare provides simple integration with social network authorization lib Hybridauth in Yii.
 *
 * HOAuthShare requires, that your user model implements findByEmail() method, that should return user model by its email.
 *
 * Avaible social networks: 
 *    OpenID, Google, Facebook, Twitter, Yahoo, MySpace, Windows Live, LinkedIn, Foursquare, AOL
 * Additional social networks can be found at: {@link http://hybridauth.sourceforge.net/download.html}
 *
 * Social Auth widget:
 *    <?php $this->widget('ext.hoauth.HOAuthWidget', array(
 *      'controllerId' => 'site', // id of controller where is your oauth action (default: site)
 *    )); ?>
 * uses a little modified Zocial CSS3 buttons: {@link https://github.com/samcollins/css-social-buttons/}
 */


Yii::setPathOfAlias('hoauth', dirname(__FILE__));

class HOAuthShareAction extends CAction
{
	/**
	 * @var boolean $enabled defines whether the ouath functionality is active. Useful for example for CMS, where user can enable or disable oauth functionality in control panel
	 */
	public $enabled = true;

	/**
	 * @var string $model yii alias for user model (or class name, when this model class exists in import path)
	 */
	public $model = 'User';

	/**
	 * @var array $attributes attributes synchronization array (user model attribute => oauth attribute). List of available profile attributes you can see at {@link http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Profile.html "HybridAuth's Documentation"}.
	 *
	 * Additional attributes:
	 *    birthDate - The full date of birthday, eg. 1991-09-03
	 *    genderShort - short representation of gender, eg. 'm', 'f'
	 *
	 * You can also set attributes, that you need to save in model too, eg.:
	 *    'attributes' => array(
	 *      'is_active' => 1,
	 *      'date_joined' => new CDbExpression('NOW()'),
	 *    ),
	 *
	 * @see HOAuthShare::$avaibleAtts
	 */
	public $attributes;

	/**
	 * @var string $scenario scenario name for the $model (optional)
	 */
	public $scenario = 'insert';

	/**
	 * @var string $loginAction name of a local login action
	 */
	public $loginAction = 'actionLogin';

	/**
	 * @var integer $duration how long the script will remember the user
	 */
	public $duration = 2592000; // 30 days

	/**
	 * @var boolean $useYiiUser enables support of Yii user module
	 */
	public static $useYiiUser = false;

	/**
	 * @var boolean $alwaysCheckPass flag to control password checking for the scenario, 
	 *      when when social network returned email of existing local account. If set to
	 *      `false` user will be automatically logged in without confirming account with password
	 */
	public $alwaysCheckPass = true;

	/**
	 * @var string $userIdentityClass UserIdentity class that will be used to log user in.
	 */
	public $userIdentityClass = 'UserIdentity';

	/**
	 * @var string $usernameAttribute you can specify the username attribute, when user must fill it
	 */
	public $usernameAttribute = false;

	/**
	 * @var string $_emailAttribute
	 */
	protected $_emailAttribute = false;

	/**
	 * @var array $avaibleAtts Hybridauth attributes that support by this script (this a list of all available attributes in HybridAuth 2.0.11) + additional attributes (see $attributes)
	 */
	protected $_avaibleAtts = array('identifier', 'profileURL', 'webSiteURL', 'photoURL', 'displayName', 'description', 'firstName', 'lastName', 'gender', 'language', 'age', 'birthDay', 'birthMonth', 'birthYear', 'email', 'emailVerified', 'phone', 'address', 'country', 'region', 'city', 'zip', 'birthDate', 'genderShort');

	public function run()
	{		
		// openId login
		if($this->enabled)
		{
			$path = dirname(__FILE__);
			if(isset($_GET['provider']))
			{
				Yii::import('hoauth.models.*');
				$this->oAuthShare($_GET['provider']);
			}
			else
			{
				require($path.'/hybridauth/index.php');
				Yii::app()->end();
			}
		}
	}

	/**
	 * Initiates authorization with specified $provider and 
	 * then authenticates the user, when all goes fine
	 * 
	 * @param mixed $provider provider name for HybridAuth
	 * @access protected
	 * @return void
	 */
	protected function oAuthShare( $provider )
	{
		try{
			// trying to authenticate user via social network
			$oAuth = UserOAuth::model()->authenticate( $provider,$this->id );
                        $adapter = UserOAuth::model()->getAdapter($provider);
                        $contacts = $adapter->getUserContacts();
                    ?>
                    <script>
                        $(function(){
                            $('.box-spinner').hide();
                        });
                    </script>
                    <?php    
                        if($contacts && count($contacts) > 0){
                            $this->controller->renderPartial(
                                    '//lotteries/_friendList', 
                                    array(
                                        'list'=>$contacts,
                                        'provider'=>$provider,
                                        'appId'=>$adapter->config['keys']['id'],
                                    ), 
                                    false, true
                            );
                            Yii::app()->end();
                        }
		}
		catch( Exception $e ){
			$error = "";

			// Display the received error
			switch( $e->getCode() ){ 
				case 0 : $error = "Unspecified error."; throw $e; break;
				case 1 : $error = "Hybriauth configuration error."; break;
				case 2 : $error = "Provider not properly configured."; break;
				case 3 : $error = "Unknown or disabled provider."; break;
				case 4 : $error = "Missing provider application credentials."; break;
				case 5 : $error = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;
				case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again."; 
				$oAuth->logout(); 
				break;
				case 7 : $error = "User not connected to the provider."; 
				$oAuth->logout(); 
				break;
				case 8 : $error = "Provider does not support this feature.";	break;
			}

			$error .= "\n\n<br /><br /><b>Original error message:</b> " . $e->getMessage(); 
			Yii::log($error, CLogger::LEVEL_INFO, 'hoauth.'.__CLASS__);
			if(YII_DEBUG)
				throw $e;
		}
		?>
		
		<?php
	}
	
	public static function t($message,$params=array(),$source=null,$language=null)
	{
		return Yii::t('HOAuthAction.root', $message,$params,$source,$language);
	}
}
