<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	public $subscriptionForm;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','ajaxCheckUsername'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('buyCredit','myProfile','editNewsletter'),
				'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
                                'expression' => 'Yii::app()->user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
                                'expression' => 'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionAjaxCheckUsername()
        {
            $username = $_POST['RegisterForm']['username'];
            $user = Users::model()->find('t.username = "'.$username.'"');
            if($user){
                return false;
            } else {
                return true;
            }
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save()){
                            $profile= new UserProfiles;
                            $profile->user_id=$model->id;
                            $profile->save();
                            $this->redirect(Yii::app()->baseUrl);
                        }
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionMyProfile()
	{                
                $model = Users::model()->getMyProfile();
                Yii::import("xupload.models.XUploadForm");
                $this->upForm = new XUploadForm;
                $this->locationForm=new Locations;
                $this->subscriptionForm = new SubscriptionForm;
                if($model->id){
                    $existLoc=Locations::model()->findByPk($model->location_id);
                    if($existLoc)
                        $this->locationForm=$existLoc;
                } 
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserProfiles']))
		{
                    if($_POST['filename'][0]){
                        $_POST['UserProfiles']['img']=$_POST['filename'][0];
                    }
                    if($_POST['Locations']){
                        //check if Location exist
                        $model->location_id = $this->saveLocation($_POST['Locations']);
                        $model->save();
                    }
                    if($_POST['Users']['user_type_id']){
                        $model->user_type_id = $_POST['Users']['user_type_id'];
                        $model->save();
                    }
                    $model->profile->attributes=$_POST['UserProfiles'];
                    $model->profile->gender=$_POST['UserProfiles']['gender'];
                    if($model->profile->save())
                        $this->redirect(array('myProfile'));
		} 

		$this->render('myProfile',array(
			'model'=>$model,
		));
	}
        
        /**
	 * Save newsletter changes
	 */
	public function actionEditNewsletter()
	{        
            $data = array();
            $error = array();
            $this->subscriptionForm = new SubscriptionForm;
            if(isset($_POST['SubscriptionForm'])){
                $catEqual= $this->subscriptionForm->catSelections == $_POST['SubscriptionForm']['catSelections'];
                $othEqual= $this->subscriptionForm->othSelections == $_POST['SubscriptionForm']['othSelections'];
                if(!$catEqual || !$othEqual){
                    if(!$_POST['SubscriptionForm']['privacyOk'] || !$_POST['SubscriptionForm']['termsOk']){
                        if(!$_POST['SubscriptionForm']['privacyOk']){
                            $this->subscriptionForm->addError('privacyOk', 'You must accept privacy policy!');
                        }
                        if(!$_POST['SubscriptionForm']['termsOk']){
                            $this->subscriptionForm->addError('termsOk', 'You must accept terms & conditions!');
                        }
                    } else {
                        $user = $this->loadModel(Yii::app()->user->id);
                        $user->newsletter_terms = $_POST['SubscriptionForm']['termsOk'];
                        $user->newsletter_privacy = $_POST['SubscriptionForm']['privacyOk'];
                        if($user->save()){
                            if(isset($_POST['SubscriptionForm']['catSelections'])){
                                $error['cat'] = array();
                                $cats = $_POST['SubscriptionForm']['catSelections'];
                                foreach($cats as $cat){
                                    // check for already subscribed
                                    if(!in_array($cat, $this->subscriptionForm->catSelections)){
                                        $sub = Subscriptions::createNewSubscription('cat',$cat);
                                        if($sub->save()){

                                        } else {
                                            $error['cat'][] = $cat;
                                        }
                                    }
                                }
                                // delete removed
                                foreach($this->subscriptionForm->catSelections as $selCat){
                                    if(!in_array($selCat,$cats)){
                                        $remSub = Subscriptions::model()->find('nl_type = "cat" and nl_type_id = '.$selCat.' and user_id = '.Yii::app()->user->id)->delete();
                                    }
                                }
                            }
                            if(isset($_POST['SubscriptionForm']['othSelections'])){
                                $error['oth'] = array();
                                $oths = $_POST['SubscriptionForm']['othSelections'];
                                foreach($oths as $oth){
                                    // check for already subscribed
                                    if(!in_array($oth, $this->subscriptionForm->othSelections)){
                                        $sub = Subscriptions::createNewSubscription('oth',$oth);
                                        if($sub->save()){

                                        } else {
                                            $error['oth'][] = $oth;
                                        }
                                    }
                                }
                                // delete removed
                                foreach($this->subscriptionForm->othSelections as $selOth){
                                    if(!in_array($selOth,$oths)){
                                        $remSub = Subscriptions::model()->find('nl_type = "oth" and nl_type_id = '.$selOth.' and user_id = '.Yii::app()->user->id)->delete();
                                    }
                                }
                            }
                            $this->subscriptionForm = new SubscriptionForm;
                        } else {
                            $this->subscriptionForm->addError('privacyOk', 'Error saving user acceptance');
                        }
                    }
                    $data["error"] = $error;
                    foreach($error['cat'] as $err){
                        $this->subscriptionForm->addError('catSelections', 'Error saving subscription(s)');
                    }
                    foreach($error['oth'] as $err){
                        $this->subscriptionForm->addError('othSelections', 'Error saving subscription(s)');
                    }
                }
            }
            
            $data["model"] = $this->loadModel(Yii::app()->user->id);
            $this->renderPartial('_newsletter', $data, false, true);
        }
        
        /**
	 * Buy credit for user a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionBuyCredit()
	{        
                if(isset($_POST['Users']))
		{
                    $model=Users::model()->getMyProfile();
                    if(isset($_POST['Users']['creditOption']) && $_POST['Users']['creditOption'] !== ""){
                        $credit=(float) Yii::app()->params['buyCreditOptions'][$_POST['Users']['creditOption']];
                        if(is_float($credit) and $credit > 0){
                            $this->_finalizeBuyCredit($credit,$model);
                        } else {
                            $model->addError('creditOption','Credit option not set or not valid!');
                        }
                    } elseif(isset($_POST['Users']['creditValue']) && $_POST['Users']['creditValue'] !== ""){
                        $credit=(float) $_POST['Users']['creditValue'];
                        if(is_float($credit) and $credit > 0){
                            $this->_finalizeBuyCredit($credit,$model);
                        } else {
                            $model->addError('creditValue','Credit value not set or not valid!');
                        }
                    } else {
                        $model->addError('creditOption','Please, select a credit option o insert a credit value');
                    }
		} else {
                    $model->addError('creditOption','Form error');
                }
                Yii::import("xupload.models.XUploadForm");
                $this->upForm = new XUploadForm;
                $this->renderPartial('_buyCredit',array(
			'model'=>$model,
                        'this'=>$this,
		),false,true);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        private function _finalizeBuyCredit($credit,$user) {
            //TODO: manage PAYPAL!!!!
            $dbTransaction=$user->dbConnection->beginTransaction();
            $user->available_balance_amount+=$credit;
            if($user->save()){
                if(UserTransactions::model()->addBuyCreditTrans($credit)){
                    $dbTransaction->commit();
                } else {
                    $dbTransaction->rollback();
                }
            } else {
                $dbTransaction->rollback();
            }
        }
}
