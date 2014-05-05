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
class Locations extends PActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address, addressLat, addressLng', 'required'),
			array('addressLat, addressLng', 'numerical'),
			array('address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, address, addressLat, addressLng, addressCity, addressState, addressCountry', 'safe', 'on'=>'search'),
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
			'address' => 'Address',
			'addressLat' => 'Latitude',
			'addressLng' => 'Longitude',
		);
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
        
        public function orderByDistance($geoData){
            $locations = Yii::app()->db->createCommand()
                        ->select('id, ( 3959 * acos( cos( radians(37) ) * cos( radians('.$geoData['addressLat'].') ) * cos( radians('.$geoData['addressLng'].') - radians(-122) ) + sin( radians(37) ) * sin( radians( '.$geoData['addressLat'].' ) ) ) ) AS distance')
                        ->from('locations')
//                        ->having('distance < 1000')
                        ->order('distance')
                        ->queryRow();
            return $locations;
        }
}
