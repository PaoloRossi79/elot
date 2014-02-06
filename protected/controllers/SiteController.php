<?php

class SiteController extends Controller
{
        public $layout='//layouts/basecolumn';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        'oauth' => array(
                            // the list of additional properties of this action is below
                            'class'=>'ext.hoauth.HOAuthAction',
                            // Yii alias for your user's model, or simply class name, when it already on yii's import path
                            // default value of this property is: User
                            'model' => 'Users', 
                            // map model attributes to attributes of user's social profile
                            // model attribute => profile attribute
                            // the list of avaible attributes is below
                            'attributes' => array(
                              'email' => 'email',
                              'ext_id' => 'identifier',
                              'password' => 'identifier',
                              'username' => 'displayName',
                              'profile->first_name' => 'firstName',
                              'profile->last_name' => 'lastName',
                              'profile->gender' => 'genderShort',
                              'profile->birthday' => 'birthDate',
                              'profile->img' => 'photoURL',
                              // you can also specify additional values, 
                              // that will be applied to your model (eg. account activation status)
                              /*'acc_status' => 1,*/
                            ),
                        ),
                        'oauthshare' => array(
                            // the list of additional properties of this action is below
                            'class'=>'ext.hoauth.HOAuthShare',
                            // Yii alias for your user's model, or simply class name, when it already on yii's import path
                            // default value of this property is: User
                            'model' => 'Users', 
                            // map model attributes to attributes of user's social profile
                            // model attribute => profile attribute
                            // the list of avaible attributes is below
                            'attributes' => array(
                              'email' => 'email',
                              'ext_id' => 'identifier',
                              'password' => 'identifier',
                              'username' => 'displayName',
                              'profile->first_name' => 'firstName',
                              'profile->last_name' => 'lastName',
                              'profile->gender' => 'genderShort',
                              'profile->birthday' => 'birthDate',
                              'profile->img' => 'photoURL',
                              // you can also specify additional values, 
                              // that will be applied to your model (eg. account activation status)
                              /*'acc_status' => 1,*/
                            ),
                        ),
                        // this is an admin action that will help you to configure HybridAuth 
                        // (you must delete this action, when you'll be ready with configuration, or 
                        // specify rules for admin role. User shouldn't have access to this action!)
                        'oauthadmin' => array(
                            'class'=>'ext.hoauth.HOAuthAdminAction',
                        ),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                $this->layout='//layouts/index';
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
            // collect user input data
            if (isset($_POST['LoginForm']))
            {   
                $model = new LoginForm;
                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login())
                {
                    $data = array(
                        'authenticated' => true,
                        'redirectUrl' => $_POST['LoginForm']['originUrl'],
                        'afterLogin' => true,
                    );
                } else {
                    $data = array(
                        'authenticated' => false,
                        'redirectUrl' => Yii::app()->user->returnUrl,
                        'afterLogin' => true,
                        'showLogin' => true,
                    );
                }
                $data['model'] = $model;
            }
            $this->renderPartial('login', $data, false, true);
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model=new RegisterForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['RegisterForm']))
		{
                        // check if already registered
                        $already = Users::model()->find('email = "'.$_POST['RegisterForm']['email'].'"');
                        if($already){
                            $model->addError('email', 'Email already registered. Try login.');
                        } else {
                            $model->attributes=$_POST['RegisterForm'];
                            // validate user input and redirect to the previous page if valid
                            if($model->validate() && $model->register())
                                    $this->redirect(Yii::app()->homeUrl);
                        }
		}
		// display the login form
		$this->render('register',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
	public function actionSocialShare()
	{
		$facebook = Yii::app()->hoAuth->getAdapter('Facebook');
                $facebook->isUserConnected();
                $user = $facebook->getUserProfile();
                echo $user->email;
                echo $user->photoURL;
                $facebook->api()->api('/me/friends', "post", array(message => "Hi there")); // post 
	}
        
        /*public function hoauthAfterLogin($user,$newUser) {
            $this->redirect(Yii::app()->user->returnUrl);
        }*/
        
        
}