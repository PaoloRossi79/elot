<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $created
 * @property string $modified
 * @property string $user_type_id
 * @property string $email
 * @property string $password
 * @property string $fb_user_id
 * @property string $twitter_user_id
 * @property string $cookie_hash
 * @property string $cookie_time_modified
 * @property integer $is_agree_terms_conditions
 * @property integer $is_agree_personaldata_management
 * @property integer $is_active
 * @property integer $is_email_confirmed
 * @property string $signup_ip
 * @property string $last_login_ip
 * @property string $last_logged_in_time
 * @property double $available_balance_amount
 * @property string $dns
 * @property double $wallet_value_bonus
 */
class Users extends PActiveRecord
{
    
        public $creditOption;
        public $creditValue;
        public $giftUserid;
        public $giftUsername;
        public $is_guaranted = 0;
        public $avg_rating = 0;
//        public $newsletter;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_type_id, email, password, is_agree_terms_conditions, is_active, is_email_confirmed', 'required'),
			array('is_agree_terms_conditions, is_agree_personaldata_management, is_active, is_email_confirmed', 'numerical', 'integerOnly'=>true),
			array('available_balance_amount, wallet_value_bonus', 'numerical'),
			array('user_type_id, is_guaranted_seller', 'length', 'max'=>2),
			array('email', 'email'),
			array('email, dns', 'length', 'max'=>255),
			array('password', 'length', 'max'=>100),
			array('cookie_hash', 'length', 'max'=>50),
			array('ext_id', 'length', 'max'=>45),
			array('signup_ip, last_login_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created, modified, user_type_id, email, password, ext_source, ext_id, cookie_hash, cookie_time_modified, is_agree_terms_conditions, is_agree_personaldata_management, is_active, is_email_confirmed, signup_ip, last_login_ip, last_logged_in_time, available_balance_amount, dns, wallet_value_bonus, newsletter_terms, newsletter_privacy, is_guaranted_seller', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'profile' => array(self::HAS_ONE, 'UserProfiles', 'user_id'),
                    'companyProfile' => array(self::HAS_ONE, 'CompanyProfiles', 'user_id'),
                    'tickets' => array(self::HAS_MANY, 'Tickets', 'user_id'),
                    'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
                    'newsletter' => array(self::HAS_MANY, 'Subscriptions', 'user_id'),
                    'socials' => array(self::HAS_MANY, 'SocialUser', 'user_id'),
                    'offers' => array(self::HAS_MANY, 'UserSpecialOffers', 'user_id'),
                    'lotteries' => array(self::HAS_MANY, 'Lotteries', 'owner_id'),
                    'followers' => array(self::HAS_MANY, 'FollowUser', 'user_id', 'condition' => 'followers.active'),
                    'followings' => array(self::HAS_MANY, 'FollowUser', 'follower_id', 'condition' => 'followings.active'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('wonlot','ID'),
			'email' => Yii::t('wonlot','Email'),
			'password' => Yii::t('wonlot','Password'),
			'wallet_value_bonus' => Yii::t('wonlot','Wallet Value Bonus'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('user_type_id',$this->user_type_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('cookie_hash',$this->cookie_hash,true);
		$criteria->compare('cookie_time_modified',$this->cookie_time_modified,true);
		$criteria->compare('is_agree_terms_conditions',$this->is_agree_terms_conditions);
		$criteria->compare('is_agree_personaldata_management',$this->is_agree_personaldata_management);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_email_confirmed',$this->is_email_confirmed);
		$criteria->compare('signup_ip',$this->signup_ip,true);
		$criteria->compare('last_login_ip',$this->last_login_ip,true);
		$criteria->compare('last_logged_in_time',$this->last_logged_in_time,true);
		$criteria->compare('available_balance_amount',$this->available_balance_amount);
		$criteria->compare('dns',$this->dns,true);
		$criteria->compare('wallet_value_bonus',$this->wallet_value_bonus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getMyProfile(){
            $myProfile=$this->findByPk(Yii::app()->user->id);
            return $myProfile;
        }
        
        public function getUsername(){
            if($this->profile){
                return $this->profile->first_name . " " . $this->profile->last_name;
            } 
            return "";
        }
        
        public function getUserLotteries($userId) {
            $criteria = new CDbCriteria();
            try {
                $criteria->addCondition("t.owner_id=".$userId);
                $dataProvider=new CActiveDataProvider('Lotteries', array(
                    'pagination'=>array(
                        'pageSize'=>8,
                    ),
                    'criteria'=>$criteria,
                ));

                return $dataProvider;
            } catch(Exception $e) {
                return array();
            }
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function findByEmail($email)
        {
          return self::model()->findByAttributes(array('email' => $email));
        }
        public function setDefaults(){
            $this->user_type_id = 1;
            $this->password = rand();
            $this->is_agree_terms_conditions = 0;
            $this->is_agree_personaldata_management = 0;
            $this->is_active = 0;
            $this->is_email_confirmed = 0;
        }
        
        public function getGiftTicketsAfterRegister($source){
            // get gifted tickets suspended
            $user = Users::model()->findByPk(Yii::app()->user->id);
            $ticketRes = false;
            if($source == Yii::app()->params['authExtSource']['Email']){
                $giftCrit = new CDbCriteria();
                $giftCrit->addCondition('t.is_gift = 1');
                $giftCrit->addCondition('t.gift_ext_user = "'.$user->email.'"');
                $giftCrit->addCondition('t.status = 1');
//                $ticketRes = Tickets::model()->updateAll(array('user_id' => $user->id),$giftCrit);
                $ticketList = Tickets::model()->findAll($giftCrit);
                foreach($ticketRes as $t){
                    $t->user_id = $user->id;
                    if($t->save()){
                        Notifications::model()->sendGiftTicketNotify($t->id,$t->giftFromUser->id,Yii::app()->user->id);
                    } else {
//                        $emailRes=EmailManager::sendCronAdminEmail($errors);
                    }
                }
            } elseif($source == Yii::app()->params['authExtSource']['Facebook'] || $source == Yii::app()->params['authExtSource']['Google']){
                // get socials identities
                foreach($user->socials as $soc){
                    if($soc->login_type == $source){
                        $socExtId = $soc->ext_user_id;
                    }
                }
                $giftCrit = new CDbCriteria();
                $giftCrit->addCondition('t.is_gift = 1');
                $giftCrit->addCondition('t.status = 1');
                if($socExtId){
                    $giftCrit->addCondition('t.gift_ext_user = "'.$user->email.'"','OR');
                    $giftCrit->addCondition('t.gift_ext_user = "'.$socExtId.'"','OR');
                    $giftCrit->addCondition('t.gift_provider = "'.$source.'"','AND');
                } else {
                    $giftCrit->addCondition('t.gift_ext_user = "'.$user->email.'"');
                }
//                $ticketRes = Tickets::model()->updateAll(array('user_id' => $user->id),$giftCrit);
                $ticketList = Tickets::model()->findAll($giftCrit);
                foreach($ticketRes as $t){
                    $t->user_id = $user->id;
                    if($t->save()){
                        Notifications::model()->sendGiftTicketNotify($t->id,$t->giftFromUser->id,Yii::app()->user->id);
                    } else {
//                        $emailRes=EmailManager::sendCronAdminEmail($errors);
                    }
                }
            }
            return $ticketRes;
        }
        
        public function getConfirmLink($user){
            return Yii::app()->createAbsoluteUrl('users/confirmEmail',array('email'=>$user->email,'id'=>$user->id));
        }
        
        public static function getImageTag($user, $dimension = "smallThumb"){
            $url = "";
            $class = "img-thumbnail";
            if($dimension == "smallThumb"){
                $class .= " img-avatar";
            }
            if(!$user || get_class($user) != "Users"){
                return $url;
            }
            if($user->user_type_id == 1){
                $profileImg = $user->profile->img;
            } else if($user->user_type_id == 3){
                $profileImg = $user->companyProfile->img;
            }
            if($user->ext_source == 0){
                if(!$profileImg){
                    // try with social user
                    if($user->socials){
                        // TODO: recreate social avatar: FB & G+
                    }
                } else {
                    $url = CHtml::image("/images/userProfiles/".$user->id."/".$dimension."/".$profileImg, "User Avatar", array("class"=>$class));
                }
            } elseif (in_array($user->ext_source, array(Yii::app()->params['authExtSource']['Facebook'],Yii::app()->params['authExtSource']['Google']))) {
                $url = CHtml::image($user->profile->img, "User Avatar", array("class"=>$class));
            }
            return $url;
        }
}
