<?php

/**
 * This is the model class for table "ratings".
 *
 * The followings are the available columns in table 'ratings':
 * @property string $id
 * @property string $user_id
 * @property string $to_entity_id
 * @property string $to_entity_type
 * @property string $rating_value
 * @property string $comment
 * @property integer $spam_alert
 * @property integer $spam_check
 * @property string $spam_check_by
 * @property integer $published
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class UserBuyCredit extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_buy_credit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, amount', 'required'),
			array('id, user_id, amount, mps_payment_id, status, currency, error_msg, created, modified, last_modified_by', 'safe'),
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
                    'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('wonlot','ID'),
			'user_id' => Yii::t('wonlot','User'),
			'amount' => Yii::t('wonlot','Importo'),
                        'mps_payment_id' => Yii::t('wonlot','ID operazione'),
                        'status' => Yii::t('wonlot','Stato'),
                        'currency' => Yii::t('wonlot','Valuta'),
			'created' => Yii::t('wonlot','Created'),
			'modified' => Yii::t('wonlot','Modified'),
			'last_modified_by' => Yii::t('wonlot','Last Modified By'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ratings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
