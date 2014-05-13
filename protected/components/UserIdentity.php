<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
        private $_username;
        private $_email;
        public $extSource;
        const ERROR_NONE=0;
	const ERROR_EMAIL_INVALID=2;
        const ERROR_USERNAME_INVALID=3;
        const ERROR_PASSWORD_INVALID=4;
	const ERROR_STATUS_NOTACTIV=5;
	const ERROR_STATUS_EMAILCONFIRM=6;
	const ERROR_STATUS_EXTUSERINVALID=7;
	const ERROR_WRONGSOURCE=8;
        
        public function __construct($username,$password,$extSource)
	{
            $this->username=$username;
            $this->password=$password;
            $this->extSource=$extSource;
        }
        
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
                if(Yii::app()->user != null)
                    Yii::app()->user->logout();
		if (strpos($this->username,"@")) {
			$user=Users::model()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=Users::model()->findByAttributes(array('username'=>$this->username));
		}
		if($user===null){
			if (strpos($this->username,"@")) {
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
                } else {
                    if($this->extSource === 0){
                        if($user->ext_source > 0){
                            $this->errorCode=self::ERROR_WRONGSOURCE;
                            $this->extSource = $user->ext_source;
                        } //if not in this kind of ext sources...
                        elseif(sha1(Yii::app()->params['hashString'].$this->password)!==$user->password)
                                $this->errorCode=self::ERROR_PASSWORD_INVALID;
                        else if($user->is_active!=1)
                                $this->errorCode=self::ERROR_STATUS_NOTACTIV;
                        else if($user->is_email_confirmed!=1)
                                $this->errorCode=self::ERROR_STATUS_EMAILCONFIRM;
                        else {
                                $this->_id=$user->id;
                                $this->errorCode=self::ERROR_NONE;
                        }
                    } elseif($this->extSource > 0){
                        if($this->password!==$user->password)
                                $this->errorCode=self::ERROR_STATUS_EXTUSERINVALID;
                        else {
                                $this->_id=$user->id;
                                $this->errorCode=self::ERROR_NONE;
                        }
                    }
                }
		return !$this->errorCode;
	}
    
    /**
    * @return integer the ID of the user record
    */
	public function getId()
	{
		return $this->_id;
	}
        public function getUsername()
	{
		return $this->_username;
	}
        public function getEmail()
	{
		return $this->_email;
	}
        
        
        public function authenticateFacebook() 
        {
                $user=Users::model()->findByAttributes(array('ext_id'=>$this->password, 'email'=>$this->username));
                if($user != null)
                    Yii::app()->user->logout();
		if($user===null)
                        $this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($this->password!==$user->ext_id)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status==0)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
                        $this->setState('id', $user->id);
                        $this->setState('username', $user->username);
                        $this->setState('email', $user->email);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
        public function authenticateTwitter() 
        {
                $user=Users::model()->findByAttributes(array('ext_id'=>$this->username));
                if(Yii::app()->user != null)
                    Yii::app()->user->logout();
		if($user===null)
                        $this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($this->password!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status==0)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
                        $this->setState('id', $user->id);
                        $this->setState('username', $user->username);
                        $this->setState('email', $user->email);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
}