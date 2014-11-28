<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	public $subscriptionForm;
	public $tickets;
	public $ticketsProvider;
	public $userWithdraw;

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
				'actions'=>array('ajaxCheckUsername','confirmEmail','getNumUnreadNotifications'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','buyCredit','giftCredit','myProfile','editNewsletter',
                                    'setFavorite','unsetFavorite','allNotify','markNotifyRead','markNewNotifyRead',
                                    'savePayInfo','requestWithdraw','acceptPolicy','payInfo','searchTicket'),
				'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
                                'expression' => 'Yii::app()->user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionConfirmEmail()
        {
            $params = $_GET;
            if(isset($params['email']) && isset($params['id'])){
                $user = Users::model()->findByPk($params['id']);
                if($user && $user->email == $params['email']){
                    $user->is_active=1;
                    $user->is_email_confirmed=1;
                    if($user->save()){
                        Yii::app()->session['confirmEmail'] = Yii::t('wonlot','Email confermata!');
                        $identity=new UserIdentity($user->username,$user->password,Yii::app()->params['authExtSource']['site']);
                        $identity->authenticate();
                        $duration=3600*24; // 1 day
                        Yii::app()->user->login($identity,$duration);
                        // check for gifted tickets waiting
                        $ticketRes = Users::model()->getGiftTicketsAfterRegister(Yii::app()->params['authExtSource']['Email']);
                    } else {
                        Yii::app()->session['confirmEmailError'] = Yii::t('wonlot','Errore nella conferma dell\'email');
                    }
                } else {
                    Yii::app()->session['confirmEmailError'] = Yii::t('wonlot','Link di conferma non valido');
                }
            } else {
                Yii::app()->session['confirmEmailError'] = Yii::t('wonlot','Link di conferma non valido');
            }
            $this->redirect('/');
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
        
        public function actionAcceptPolicy() {
            $acceptForm = new AcceptPrivacyForm();
            if($_POST['AcceptPrivacyForm']){
                if($_POST['AcceptPrivacyForm']['terms'] && $_POST['AcceptPrivacyForm']['persdatamng']){
                    $user = Yii::app()->user->getUserModel();
                    $user->is_agree_terms_conditions = 1;
                    $user->is_agree_personaldata_management = 1;
                    $user->is_active = 1;
                    $user->is_email_confirmed = 1;
                    $user->save();
                    $acceptForm->complete = 1;
                }
                if(!$_POST['AcceptPrivacyForm']['terms']){
                    $acceptForm->addError('terms', Yii::t("wonlot","Devi accettare i \"Termini e Condizioni\""));
                }
                if(!$_POST['AcceptPrivacyForm']['persdatamng']){
                    $acceptForm->addError('persdatamng', Yii::t("wonlot","Devi accettare i termini di gestione dei dati personali"));
                }
            }
            $this->renderPartial("/site/acceptPolicyForm", array('model'=>$acceptForm));   
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGetNumUnreadNotifications(){
            $unreadNotifyCount = array();
            if(!Yii::app()->user->isGuest()){
                $unreadNotifyCount = Notifications::model()->getCountUnreadNotifications();
            }
            echo $unreadNotifyCount;
        }
        
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionPayInfo()
	{
		$this->render('payInfo',array());
	}
        
	public function actionAllNotify()
	{
                $dataProvider=  Notifications::model()->getLastNotifications($_GET['Notifications_sort']);
                $this->render('allNotify',array(
                    'dataProvider'=>$dataProvider,
		));
	}
        
	public function actionMarkNotifyRead()
	{
                $userId = Yii::app()->user->id;
                if(isset($_POST['notifyId'])){
                    $notifyId = $_POST['notifyId'];
                    $notify = Notifications::model()->findByPk($notifyId);
                    if($notify){
                        if($notify->to_user_id == $userId){
                            $notify->message_read = 1;
                            if($notify->save()){
                                echo CJSON::encode(1);
                                return;
                            }
                        }
                    }
                    echo CJSON::encode(0);
                } else {
                    echo CJSON::encode(0);
                }
	}
        public function actionMarkNewNotifyRead()
	{
            $userId = Yii::app()->user->id;
            // set all to READ after loading
            try {
                $updResult = Yii::app()->db->createCommand()->update('notifications',array('message_read'=>1),'to_user_id = '.$userId);
                echo CJSON::encode(1);
            } catch (Exception $e){
                echo CJSON::encode(0);
            }
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
			$model->save();
//				$this->redirect(array('view','id'=>$model->id));
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
        
        public function actionDeleteMyUser()
	{
                $userId = Yii::app()->user->id;
                try {
                    $this->loadModel($userId)->delete();
                } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                }

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
        
	public function actionSavePayInfo()
	{
            if(isset($_POST['UserPaymentInfo'])){
                $userOk = false;
                $userInfo = $_POST['UserPaymentInfo'];
                if($userInfo['id']){
                    $userInfoModel = UserPaymentInfo::model()->findByPk($userInfo['id']);
                } else {
                    $userInfoModel = new UserPaymentInfo;
                    $_POST['UserPaymentInfo']['user_id'] = Yii::app()->user->id;
                }
                $userInfoModel->setAttributes($_POST['UserPaymentInfo']);
                if(!$userInfoModel->legal_name || !$userInfoModel->address){
                    /*echo CJSON::encode(array('res'=>0,'errMsg'=>Yii::t('wonlot','Nome e Indirizzo sono obbligatori')));
                    return;*/
                    $resError = Yii::t('wonlot','Nome e Indirizzo sono obbligatori');
                    $userInfoModel->addError('legal_name',Yii::t('wonlot','Nome e Indirizzo sono obbligatori'));
                }
                if(!$userInfoModel->vat && !$userInfoModel->fiscal_number){
                    /*echo CJSON::encode(array('res'=>0,'errMsg'=>Yii::t('wonlot','Inserire almeno uno tra Partita IVA e Codice Fiscale')));
                    return;*/
                    $resError = Yii::t('wonlot','Inserire almeno uno tra Partita IVA e Codice Fiscale');
                    $userInfoModel->addError('vat',Yii::t('wonlot','Inserire almeno uno tra Partita IVA e Codice Fiscale'));
                }
                if($_POST['for_credit']){
                    if(!$userInfoModel->iban && !$userInfoModel->paypal_account){
                        /*echo CJSON::encode(array('res'=>0,'errMsg'=>Yii::t('wonlot','Inserire almeno uno tra IBAN e Account Paypal')));
                        return;*/
                        $resError = Yii::t('wonlot','Inserire almeno uno tra IBAN e Account Paypal');
                        $userInfoModel->addError('iban',Yii::t('wonlot','Inserire almeno uno tra IBAN e Account Paypal'));
                    }
                }
                if(!$userInfoModel->hasErrors() && $userInfoModel->save()){
                    $userOk = true;
                } else {
                    $resError = Yii::t('wonlot','Salvataggio dei dati non riuscito');
                }

                if($userOk && (isset($_POST['for_profile']) || isset($_POST['for_credit']))){
                    $resOk = Yii::t('wonlot','Dati di pagamento salvati');
                } /*else {
                    if($userOk && isset($_POST['lot_id'])){
                        $lottery = Lotteries::model()->findByPk($_POST['lot_id']);
                        if($lottery){
                            if($lottery->paidInfo){
                                if($lottery->paidInfo->is_completed){
                                    $resError = Yii::t('wonlot','Asta già pagata');
                                } else {
                                    $resError = Yii::t('wonlot','Asta già in attesa di pagamento');
                                }
                            } else {
                                $payReq = new LotteryPaymentRequest;
                                $payReq->lottery_id = $lottery->id;
                                $payReq->from_user_id = Yii::app()->user->id;
                                $payReq->sent_date = new CDbExpression('NOW()');
                                if($payReq->save()){
                                    $lottery->paid_ref_id = $payReq->id;
                                    if($lottery->save()){
    //                                    echo CJSON::encode(array('res'=>1,'okMsg'=>Yii::t('wonlot','Richiesta di pagamento inviata')));
    //                                    return;
                                        $resOk = Yii::t('wonlot','Richiesta di pagamento inviata');
                                    } else {
    //                                    echo CJSON::encode(array('res'=>0,'errMsg'=>Yii::t('wonlot','Errore nell\'invio della richiesta')));
    //                                    return;
                                        $resError = Yii::t('wonlot','Errore nell\'invio della richiesta');
                                    }
                                } else {
                                    $resError = Yii::t('wonlot','Errore nell\'invio della richiesta');
                                }
                            }
                        } else {
                            $resError = Yii::t('wonlot','Asta non trovata');
                        }
                    } else {
                        $resError = Yii::t('wonlot','Asta non trovata');
                    }
                }*/
            } else {
                //echo CJSON::encode(array('res'=>0,'errMsg'=>Yii::t('wonlot','Dati di pagamento mancanti')));
                $resError = Yii::t('wonlot','Dati di pagamento mancanti');
            }
            /*if($_POST['return_url']){
                $this->redirect($_POST['return_url']);
            }*/
            $this->renderPartial('_billForm',array(
                    'this'=>$this,
                    'paymentInfo'=>$userInfoModel,
                    'resError'=>$resError,
                    'resOk'=>$resOk,
                    'redirect'=>$_POST['return_url']
            ),false,true);
	}
        
        public function actionRequestWithdraw(){
            if(isset($_POST['UserWithdraw'])){
                $user = Yii::app()->user->loadUser(Yii::app()->user->id);
                $withdraw = $_POST['UserWithdraw'];
                if(isset($withdraw['creditValue'])){
                    $withdrawVal = (float) $withdraw['creditValue'];
                    if($withdrawVal && $withdrawVal > 0){
                        if($withdrawVal >= 7){
                            $withdrawValWithCommission = $withdrawVal + ($withdrawVal / 100) * 1;
                            $userInfoModel = UserPaymentInfo::model()->find('t.user_id = '.$user->id);
                            if($userInfoModel && (!empty($userInfoModel->paypal_account) || !empty($userInfoModel->iban))){
                                if($withdrawValWithCommission <= Yii::app()->user->walletValue){
                                    $drawReq = new UserWithdraw;
                                    $drawReq->user_id = $user->id;
                                    $drawReq->value = $withdrawValWithCommission;
                                    $drawReq->status = 1;

                                    $dbTransaction=$user->dbConnection->beginTransaction();
                                    $user->available_balance_amount-=$drawReq->value;
                                    if($user->save()){
                                        if($drawReq->save()){
                                            if(UserTransactions::model()->addDrawCreditTrans($drawReq->value,$user,$drawReq)){
                                                $dbTransaction->commit();
                                                Notifications::model()->sendDrawCreditNotify($drawReq->value,$user,$drawReq);
                                                $resOk = Yii::t('wonlot','Richiesta di ritiro denaro inviata');
                                            } else {
                                                $dbTransaction->rollback();
                                                $resError = Yii::t('wonlot','Errore nell\'invio della richiesta');
                                            }
                                        } else {
                                            $dbTransaction->rollback();
                                        }
                                    } else {
                                        $dbTransaction->rollback();
                                    }
                                } else {
                                    $resError = Yii::t('wonlot','L\'importo selezionato è maggiore di quello disponibile');
                                }
                            } else {
                                $resError = Yii::t('wonlot','Dati di pagamento mancanti');
                            }
                        } else {
                            $resError = Yii::t('wonlot','L\'importo minimo da ritirare è 7 €');
                        }
                    } else {
                        $resError = Yii::t('wonlot','Valore da ritirare mancante o errato');
                    }
                } else {
                    $resError = Yii::t('wonlot','Valore da ritirare mancante o errato');
                }
            }
                
            $this->userWithdraw = new UserWithdraw;
            $this->renderPartial('_withCreditForm',array(
                    'this'=>$this,
                    'resError'=>$resError,
                    'resOk'=>$resOk,
            ),false,true);
        }
        
        public function actionMyProfile()
	{                
                $model = Users::model()->getMyProfile();
                Yii::import("xupload.models.XUploadForm");
                $this->upForm = new XUploadForm;
                $this->locationForm=new Locations;
                $this->subscriptionForm = new SubscriptionForm;
                $this->tickets = Tickets::model()->getMyTickets(array());
                $this->ticketsProvider = Tickets::model()->getMyTicketsProvider();
                $this->userWithdraw = new UserWithdraw;
                if($model->id){
                    $existLoc=Locations::model()->findByPk($model->location_id);
                    if($existLoc)
                        $this->locationForm=$existLoc;
                } 
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $toSave = false;
                $errProfileSave = false;
                if($_POST['Users']['user_type_id'] == 3){
                    if(isset($_POST['CompanyProfiles'])){
                        if(!$model->companyProfile){
                            $model->companyProfile = new CompanyProfiles();
                        }
                        if($_POST['filename'][0]){
                            $_POST['CompanyProfiles']['img']=$_POST['filename'][0];
                        }
                        if(!$model->companyProfile->user_id){
                            $model->companyProfile->user_id = $model->id;
                        }
                        $model->companyProfile->attributes=$_POST['CompanyProfiles'];
                        if(!$model->companyProfile->save()){
//                            $this->redirect(array('myProfile'));
//                            $model->addError('id','Errore nel salvataggio del profilo azienda');
                            $errProfileSave = true;
                        }
                    } 
                }
                if($_POST['Users']['user_type_id'] == 1 || $_POST['Users']['user_type_id'] == 2 || !$model->user_type_id){
                    if(isset($_POST['UserProfiles'])){
                        if($_POST['filename'][0]){
                            $_POST['UserProfiles']['img']=$_POST['filename'][0];
                        }
                        if(!$model->profile->user_id){
                            $model->profile->user_id = $model->id;
                        }
                        $model->profile->attributes=$_POST['UserProfiles'];
                        $model->profile->gender=$_POST['UserProfiles']['gender'];
                        if(!$model->profile->save()){
//                            $model->addError('id','Errore nel salvataggio del profilo utente');
                            $errProfileSave = true;
                        }
                    } 
                } 
                
                if($_POST['Locations']){
                    //check if Location exist
                    $model->location_id = $this->saveLocation($_POST['Locations']);
                    $toSave = true;
                }
                if($_POST['Users']['user_type_id']){
                    $model->user_type_id = $_POST['Users']['user_type_id'];
                    $toSave = true;
                }
                if($_POST['Users']['username']){
                    $model->username = $_POST['Users']['username'];
                    $toSave = true;
                }
                if($toSave && !$errProfileSave){
                    if(!$model->save()){
                        $model->addError('id','Errore nel salvataggio dell\'utente');
                    }
                }

		$this->render('myProfile',array(
			'model'=>$model,
		));
	}
        
        public function actionPageTicket(){
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->tickets = Tickets::model()->getMyTickets($_POST);
            $this->renderPartial('_tickets', array('tickets'=>$this->tickets),false,true);
        }
        
        public function actionSearchTicket(){
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->tickets = Tickets::model()->getMyTickets($_POST);
            $this->renderPartial('_tickets', array('tickets'=>$this->tickets));
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
                            $model->addError('creditOption',Yii::t("wonlot","Credito non selezionato o non valido"));
                        }
                    } elseif(isset($_POST['Users']['creditValue']) && $_POST['Users']['creditValue'] !== ""){
                        $credit=(float) $_POST['Users']['creditValue'];
                        if(is_float($credit) and $credit > 0){
                            $this->_finalizeBuyCredit($credit,$model);
                        } else {
                            $model->addError('creditOption',Yii::t("wonlot","Credito non selezionato o non valido"));
                        }
                    } else {
                        $model->addError('creditOption',Yii::t("wonlot","Selezionare un valore per il credito"));
                    }
		} else {
                    $model->addError('creditOption','Form error');
                }
                $this->redirect('myProfile#tabProfile2',array(
			'model'=>$model,
                        'this'=>$this,
		),false,true);
	}
        /**
	 * Buy credit for user a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGiftCredit()
	{       
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                if(isset($_POST['Users']))
		{
                    $myUser=Users::model()->getMyProfile();
                    if($_POST['Users']['giftUserid']){
                        $giftUser=Users::model()->findByPk($_POST['Users']['giftUserid']);
                    }
                    if(!$giftUser){
                        $myUser->addError('giftUsername','Nessun utente selezionato');
                    } else {
                        if(isset($_POST['Users']['creditOption']) && $_POST['Users']['creditOption'] !== ""){
                            $credit=(float) Yii::app()->params['buyCreditOptions'][$_POST['Users']['creditOption']];
                        } elseif(isset($_POST['Users']['creditValue']) && $_POST['Users']['creditValue'] !== ""){
                            $credit=(float) $_POST['Users']['creditValue'];
                        } else {
                            $myUser->addError('creditOption','Selezionare o inserire un valore di credito valido');
                        }

                        if(is_float($credit) and $credit > 0){
                            //check for credit:
                            if(Yii::app()->user->getRemainingGiftCredit() >= $credit){
                                if($myUser->available_balance_amount > $credit){
                                    $dbTransaction=$myUser->dbConnection->beginTransaction();
                                    $myUser->available_balance_amount-=$credit;
                                    $giftUser->available_balance_amount+=$credit;
                                    if($myUser->save() && $giftUser->save()){
                                        if(UserTransactions::model()->addGiftCreditTransTo($credit,$myUser,$giftUser)
                                                &&
                                           UserTransactions::model()->addGiftCreditTransFrom($credit,$myUser,$giftUser)
                                        ){
                                            $dbTransaction->commit();
                                            // TODO: add notifications and email for gift!!!
                                            Notifications::model()->sendGiftCreditNotify($credit,$myUser->id,$giftUser->id);
                                            $this->opMessage = Yii::t('wonlot','Hai regalato ').$credit.' WlMoney '.Yii::t('wonlot','a ').$giftUser->username;
                                        } else {
                                            $dbTransaction->rollback();
                                        }
                                    } else {
                                        $dbTransaction->rollback();
                                    }
                                } else {
                                    $myUser->addError('creditValue','Valore del credito è maggiore del credito disponibile');
                                }
                            } else {
                                $myUser->addError('creditValue','Valore del credito è maggiore del credito regalabile disponibile');
                            }
                        } else {
                            $myUser->addError('creditValue','Valore del credito non impostato o non valido');
                        }
                    }
		} else {
                    $myUser->addError('creditOption','Form error');
                }
                $this->renderPartial('_giftCreditForm',array(
			'model'=>$myUser,
                        'this'=>$this,
		),false,true);
	}
        
        public function actionSetFavorite(){
            $userId=$_POST['userId'];
            $res = 0;
            if($userId){
                $myUserId = Yii::app()->user->id;
                $checkFav = FollowUser::model()->find('t.user_id='.$userId.' AND t.follower_id='.$myUserId);
                if($checkFav){
                    if($checkFav->active != 1){
                        $checkFav->active = 1;
                        if($checkFav->save()){
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 1;
                    }
                } else {
                    $newFav = new FollowUser;
                    $newFav->user_id = $userId;
                    $newFav->follower_id = $myUserId;
                    $newFav->active = 1;
                    if($newFav->save()){
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                }
            } else {
                $res = 0;
            }
            if($res == 1){
                Notifications::model()->sendStartFollowNotify($myUserId,$userId);
            }
            echo CJSON::encode($res);
        }
        
        public function actionUnsetFavorite(){
            $userId=$_POST['userId'];
            $res = 0;
            if($userId){
                $myUserId = Yii::app()->user->id;
                $checkFav = FollowUser::model()->find('t.user_id='.$userId.' AND t.follower_id='.$myUserId);
                if($checkFav){
                    if($checkFav->active != 0){
                        $checkFav->active = 0;
                        if($checkFav->save()){
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    }
                } else {
                    $res = 1;
                }
            } else {
                $res = 0;
            }
            if($res == 1){
                Notifications::model()->sendStopFollowNotify($myUserId,$userId);
            }
            echo CJSON::encode($res);
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
