<?php

/**
 * This is the model class for table "user_transactions".
 *
 * The followings are the available columns in table 'user_transactions':
 * @property string $id
 * @property string $user_id
 * @property integer $transaction_type
 * @property string $transaction_ref_id
 * @property double $value
 * @property integer $is_confirmed
 * @property string $promotion_id
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class UserTransactions extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, transaction_type, value', 'required'),
			array('transaction_type, is_confirmed, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('value', 'numerical'),
			array('user_id, promotion_id', 'length', 'max'=>10),
			array('transaction_ref_id', 'length', 'max'=>45),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, transaction_type, transaction_ref_id, value, is_confirmed, promotion_id, created, modified, last_modified_by', 'safe', 'on'=>'search'),
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
                    'relTickets' => array(self::BELONGS_TO, 'Tickets', 'transaction_ref_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'transaction_type' => 'Transaction Type',
			'transaction_ref_id' => 'Transaction Ref',
			'value' => 'Value',
			'is_confirmed' => 'Is Confirmed',
			'promotion_id' => 'Promotion',
			'created' => 'Created',
			'modified' => 'Modified',
			'last_modified_by' => 'Last Modified By',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('transaction_type',$this->transaction_type);
		$criteria->compare('transaction_ref_id',$this->transaction_ref_id,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('is_confirmed',$this->is_confirmed);
		$criteria->compare('promotion_id',$this->promotion_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('last_modified_by',$this->last_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function addBuyTicketTrans($ticketId,$ticketValue,$promotionId=null){
            $trans=new UserTransactions;
            $trans->user_id=Yii::app()->user->id;
            $trans->transaction_type=Yii::app()->params['userTransactionConst']['buyTicket'];
            $trans->transaction_ref_id=$ticketId;
            $trans->value= - $ticketValue;
            $trans->is_confirmed=1;
            $trans->promotion_id=$promotionId; // TODO: add promotion managment
            if($trans->save()){
                return true;
            } else {
                return false;
            }
        }
        
        public function addVoidTicketRepay($ticketId,$ticketValue,$userId){
            $trans=new UserTransactions;
            $trans->user_id=$userId;
            $trans->transaction_type=Yii::app()->params['userTransactionConst']['refundTicket'];
            $trans->transaction_ref_id=$ticketId;
            $trans->value=$ticketValue;
            $trans->is_confirmed=1;
            $trans->promotion_id=null; // TODO: add promotion managment
            if($trans->save()){
                return true;
            } else {
                return false;
            }
        }
        
        public function addBuyCreditTrans($credit,$promotionId=null){
            $trans=new UserTransactions;
            $trans->user_id=Yii::app()->user->id;
            $trans->transaction_type=Yii::app()->params['userTransactionConst']['buyCredit'];
            //TODO: add tracking for paypal transactions table
            $trans->value=$credit;
            //TODO: add check for paypal transactions confirm
            $trans->is_confirmed=1;
            $trans->promotion_id=$promotionId; // TODO: add promotion managment
            if($trans->save()){
                return true;
            } else {
                return false;
            }
        }
        
        public function getLinkedText($model){
            $msg="";
            if(in_array($model->transaction_type,array(Yii::app()->params['userTransactionConst']['buyTicket'],Yii::app()->params['userTransactionConst']['refundTicket']))){
                $msg = "Ticket: ".$model->relTickets->id;
            } elseif(in_array($model->transaction_type,array(Yii::app()->params['userTransactionConst']['buyCredit'],Yii::app()->params['userTransactionConst']['refundCredit']))){
                
            }
            return $msg;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
