<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $email;
	public $password;
	public $confirmEmail;
	public $confirmPassword;
	public $terms;
	public $persdatamng;
	
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, confirmEmail, password, confirmPassword', 'required'),
			array('email', 'email'),
			array('confirmEmail', 'email'),
                        // flags need to be a boolean
			array('terms, persdatamng', 'boolean'),
			// Confirmation fields need to be the same as originals
                        array('confirmPassword', 'compare', 'compareAttribute'=>'password'),
                        array('confirmEmail', 'compare', 'compareAttribute'=>'email'),
		);
	}
        
        /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}
        
	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function register()
	{
            $model=new Users;
            $model->email=$this->email;
            $model->password=sha1(Yii::app()->params['hashString'].$this->password);
            $model->user_type_id=Yii::app()->user->userTypes['user'];
            $model->is_agree_terms_conditions=$this->terms;
            $model->is_agree_personaldata_management=$this->persdatamng;
            $model->is_active=1;
            //$model->is_email_confirmed=0; //ATTENTION: for PROD
            $model->is_email_confirmed=1; //ATTENTION: for DEV
            $model->signup_ip=CHttpRequest::getUserHostAddress();
            $model->dns=CHttpRequest::getUserHost();
            $dbTransaction=$model->dbConnection->beginTransaction();
            if($model->save()){
                $profile=new UserProfiles;
                $profile->user_id=$model->id;
                if($profile->save()){
                    $dbTransaction->commit();
                    // TODO: add email activation send
                    return true;
                } else {
                    $dbTransaction->rollback();
                    $model->addError('creditValue','Credit value not set or not valid!');
                }
            } else {
                $dbTransaction->rollback();
                $model->addError('email', $model->errors);
                return false;
            }
	}
}
