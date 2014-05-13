<?php

/**
 * This is the model class for table "locations".
 *
 * The followings are the available columns in table 'locations':
 * @property string $id
 * @property string $user_id
 * @property string $offer_on
 * @property string $offer_value
 * @property string $comment
 * @property string $start_date
 * @property string $end_date
 * @property integer $times_remaining
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class Notifications extends PActiveRecord
{
        public $related = array(
            'ticket' => array(1,5,9,10),
            'money' => array(2,6),
            'user' => array(3,4,7,8),
        );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, from_user_id, to_user_id, message_value, message_type, message_read, sent_date', 'safe', 'on'=>'search'),
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
                    'fromUser' => array(self::BELONGS_TO, 'Users', 'from_user_id'),
                    'toUser' => array(self::BELONGS_TO, 'Users', 'to_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
		);
	}
        
        public function getLastNotifications(){
            $userId = Yii::app()->user->id;
            $crit = new CDbCriteria();
            $crit->addCondition('t.from_user_id = '.$userId,'OR');
            $crit->addCondition('t.to_user_id = '.$userId,'OR');
            $crit->order = 't.id DESC';
            $crit->limit = 6;
            $notify = Notifications::model()->findAll($crit);
            return $notify;
        }
        
        public function getCountUnreadNotifications(){
            $userId = Yii::app()->user->id;
            $crit = new CDbCriteria();
            $crit->addCondition('t.to_user_id = '.$userId);
            $crit->addCondition('t.message_read != 1');
            $unreadNotifyCount = Notifications::model()->count($crit);
            return $unreadNotifyCount;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSpecialOffers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function sendGiftCreditNotify($value, $from, $to){
            $notify = new Notifications();
            $notify->from_user_id = $from;
            $notify->to_user_id = $to;
            $notify->message_value = $value;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['giftCredit'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendGiftTicketNotify($value, $from, $to){
            $notify = new Notifications();
            $notify->from_user_id = $from;
            $notify->to_user_id = $to;
            $notify->message_value = $value;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['giftTicket'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendStartFollowNotify($from, $to){
            $notify = new Notifications();
            $notify->from_user_id = $from;
            $notify->to_user_id = $to;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['startFollow'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendStopFollowNotify($from, $to){
            $notify = new Notifications();
            $notify->from_user_id = $from;
            $notify->to_user_id = $to;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['stopFollow'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendExtractLotteryToWinnerNotify($lottery,$ticket){
            $notify = new Notifications();
            $notify->from_user_id = 0;
            $notify->to_user_id = $ticket->user->id;
            $notify->message_value = $lottery->id;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['winLottery'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendExtractLotteryToOwnerNotify($lottery){
            $notify = new Notifications();
            $notify->from_user_id = 0;
            $notify->to_user_id = $lottery->owner->id;
            $notify->message_value = $lottery->id;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['extractLottery'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
        public function sendRefoundLotteryNotify($lottery,$user){
            $notify = new Notifications();
            $notify->from_user_id = $lottery->owner->id;
            $notify->to_user_id = $user->id;
            $notify->message_value = $lottery->id;
            $notify->message_type = Yii::app()->params['notifyTypeConst']['refoundTicket'];
            $notify->message_read = 0;
            $notify->sent_date = new CDbExpression('NOW()');
            $notify->save();
        }
        
}
