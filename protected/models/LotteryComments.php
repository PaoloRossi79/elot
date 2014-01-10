<?php

/**
 * This is the model class for table "lottery_comments".
 *
 * The followings are the available columns in table 'lottery_comments':
 * @property string $id
 * @property string $user_id
 * @property string $lottery_id
 * @property string $reply_to_comment_id
 * @property string $comment
 * @property integer $spam_alert
 * @property integer $spam_check
 * @property string $spam_check_by
 * @property integer $published
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class LotteryComments extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lottery_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, lottery_id, reply_to_comment_id, spam_check_by', 'required'),
			array('spam_alert, spam_check, published, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('user_id, lottery_id, reply_to_comment_id, spam_check_by', 'length', 'max'=>10),
			array('comment', 'length', 'max'=>45),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, lottery_id, reply_to_comment_id, comment, spam_alert, spam_check, spam_check_by, published, created, modified, last_modified_by', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'lottery_id' => 'Lottery',
			'reply_to_comment_id' => 'Reply To Comment',
			'comment' => 'Comment',
			'spam_alert' => 'Spam Alert',
			'spam_check' => 'Spam Check',
			'spam_check_by' => 'Spam Check By',
			'published' => 'Published',
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
		$criteria->compare('lottery_id',$this->lottery_id,true);
		$criteria->compare('reply_to_comment_id',$this->reply_to_comment_id,true);
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
	 * @return LotteryComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
