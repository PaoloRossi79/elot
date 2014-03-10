<?php

/**
 * This is the model class for table "subscriptions".
 *
 * The followings are the available columns in table 'subscriptions':
 * @property string $id
 * @property string $nl_type
 * @property integer $nl_type_id
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 * @property integer $is_active
 * @property string $sub_ip
 * @property string $sub_dns
 * @property integer $term_cond
 * @property integer $privacy_ok
 * @property integer $n_msg_sent
 */
class Subscriptions extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subscriptions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nl_type, nl_type_id, user_id', 'required'),
			array('nl_type_id, user_id, last_modified_by, is_active, n_msg_sent', 'numerical', 'integerOnly'=>true),
			array('nl_type, sub_ip, sub_dns', 'length', 'max'=>45),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nl_type, nl_type_id, user_id, created, modified, last_modified_by, is_active, sub_ip, sub_dns, n_msg_sent', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nl_type' => 'Nl Type',
			'nl_type_id' => 'Nl Type',
			'user_id' => 'User',
			'created' => 'Created',
			'modified' => 'Modified',
			'last_modified_by' => 'Last Modified By',
			'is_active' => 'Is Active',
			'sub_ip' => 'Sub Ip',
			'sub_dns' => 'Sub Dns',
			'term_cond' => 'Term Cond',
			'privacy_ok' => 'Privacy Ok',
			'n_msg_sent' => 'N Msg Sent',
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
		$criteria->compare('nl_type',$this->nl_type,true);
		$criteria->compare('nl_type_id',$this->nl_type_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('last_modified_by',$this->last_modified_by);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('sub_ip',$this->sub_ip,true);
		$criteria->compare('sub_dns',$this->sub_dns,true);
		$criteria->compare('term_cond',$this->term_cond);
		$criteria->compare('privacy_ok',$this->privacy_ok);
		$criteria->compare('n_msg_sent',$this->n_msg_sent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function createNewSubscription($type,$value){
            $sub = new Subscriptions;
            $sub->nl_type = $type;
            $sub->nl_type_id = $value;
            $sub->user_id = Yii::app()->user->id;
            $sub->is_active = 1;
            $sub->sub_ip = CHttpRequest::getUserHostAddress();
            $sub->sub_dns = CHttpRequest::getUserHost();
            return $sub;
        }

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Subscriptions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
