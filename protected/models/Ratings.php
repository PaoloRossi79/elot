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
class Ratings extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ratings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, to_entity_id, to_entity_type, rating_value', 'required'),
			array('spam_alert, spam_check, published, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('user_id, to_entity_id, spam_check_by', 'length', 'max'=>10),
			array('to_entity_type', 'length', 'max'=>15),
			array('rating_value', 'length', 'max'=>2),
			array('comment', 'length', 'max'=>45),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, to_entity_id, to_entity_type, rating_value, comment, spam_alert, spam_check, spam_check_by, published, created, modified, last_modified_by', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('wonlot','ID'),
			'user_id' => Yii::t('wonlot','User'),
			'to_entity_id' => Yii::t('wonlot','To Entity'),
			'to_entity_type' => Yii::t('wonlot','To Entity Type'),
			'rating_value' => Yii::t('wonlot','Rating Value'),
			'comment' => Yii::t('wonlot','Comment'),
			'spam_alert' => Yii::t('wonlot','Spam Alert'),
			'spam_check' => Yii::t('wonlot','Spam Check'),
			'spam_check_by' => Yii::t('wonlot','Spam Check By'),
			'published' => Yii::t('wonlot','Published'),
			'created' => Yii::t('wonlot','Created'),
			'modified' => Yii::t('wonlot','Modified'),
			'last_modified_by' => Yii::t('wonlot','Last Modified By'),
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
		$criteria->compare('to_entity_id',$this->to_entity_id,true);
		$criteria->compare('to_entity_type',$this->to_entity_type,true);
		$criteria->compare('rating_value',$this->rating_value,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('spam_alert',$this->spam_alert);
		$criteria->compare('spam_check',$this->spam_check);
		$criteria->compare('spam_check_by',$this->spam_check_by,true);
		$criteria->compare('published',$this->published);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('last_modified_by',$this->last_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
