<?php
class WebUser extends CWebUser {
  private $_model;
  public $userTypes;
 
  function getEmail()
  {
        $user = $this->loadUser(Yii::app()->user->id);
	return $user->email;
  }
  
  function getUsername()
  {
        $user = $this->loadUser(Yii::app()->user->id);
	return $user->username;
  }
  
  function getPayInfo()
  {
        $userPayInfo = UserPaymentInfo::model()->find('t.user_id ='.Yii::app()->user->id);
        return $userPayInfo;
  }
  
  function getWalletValue(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->available_balance_amount;
  }

  function getAvatar()
  {
	$user = $this->loadUser(Yii::app()->user->id);
	if($user!==null){
            $img = $user->profile->img;
            if($img){
                return $user->profile->img;
            }
        }
	return "";
  }
  
  function getIsAdmin()
  {
	$user = $this->loadUser(Yii::app()->user->id);
	if($user!==null)
		return ($user->user_type_id==$this->userTypes['admin']);
	return false;
  }
  
  function isAdmin()
  {
	$user = $this->loadUser(Yii::app()->user->id);
	if($user!==null)
		return ($user->user_type_id==$this->userTypes['admin']);
	return false;
  }
  
  public function login($identity,$duration=0)
  {
      if($identity->extSource==0){
          $res=parent::login($identity,$duration);
      } else {
          $authRes=$identity->authenticate();
          $res=parent::login($identity,$duration);
      }
      
      if($res){
          //track user login
          $user=$this->loadUser(Yii::app()->user->id);
          $user->last_login_ip=CHttpRequest::getUserHostAddress();
          $user->last_logged_in_time=new CDbExpression('NOW()');
          $user->save(true,null,false);
      }
      return $res;
  }
  public function logout($destroySession= true)
  {
        parent::logout();
  }

  public function loadUser($id=null)
  {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Users::model()->findByPk($id);
        }
        return $this->_model;
  }
 
  

  function isGuest()
  {
	if(Yii::app()->user->id)
		return false;
	return true;
  }
}
?>