<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $originUrl;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=> Yii::t('wonlot','Remember me next time'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password,Yii::app()->params['authExtSource']['site']);
                        $authRes = $this->_identity->authenticate();
                        switch ($this->_identity->errorCode) {
                            case UserIdentity::ERROR_EMAIL_INVALID:
                                $this->addError('username','Incorrect email');
                                break;
                            case UserIdentity::ERROR_USERNAME_INVALID:
                                $this->addError('username','Incorrect username');
                                break;
                            case UserIdentity::ERROR_PASSWORD_INVALID:
                                $this->addError('password','Incorrect password.');
                                break;
                            case UserIdentity::ERROR_STATUS_NOTACTIV:
                                $this->addError('username','User is not Active');
                                break;
                            case UserIdentity::ERROR_STATUS_EMAILCONFIRM:
                                $this->addError('username','Email not confirmed');
                                break;
                            case UserIdentity::ERROR_STATUS_EXTUSERINVALID:
                                $this->addError('username','Incorrect external user');
                                break;
                            case UserIdentity::ERROR_WRONGSOURCE:
                                $ext = array_search($this->_identity->extSource, Yii::app()->params['authExtSource']);
                                $this->addError('username','Login with '.$ext);
                                break;
                            default:
                                break;
                        }
				
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password,Yii::app()->params['authExtSource']['site']);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
                        //TODO: add cookies managment!
//			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                        if($this->rememberMe){
                            $duration=3600*24*30; // 30 days
                        } else {
                            $duration=3600*24; // 1 day
                        }
			
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
