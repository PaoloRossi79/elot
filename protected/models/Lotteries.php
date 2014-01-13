<?php

/**
 * This is the model class for table "lotteries".
 *
 * The followings are the available columns in table 'lotteries':
 * @property string $id
 * @property string $name
 * @property integer $lottery_type
 * @property string $prize_desc
 * @property integer $prize_category
 * @property string $prize_img
 * @property string $prize_conditions
 * @property string $prize_shipping
 * @property double $prize_price
 * @property integer $min_ticket
 * @property integer $max_ticket
 * @property double $ticket_value
 * @property string $lottery_start_date
 * @property string $lottery_draw_date
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class Lotteries extends PActiveRecord
{
        public $maxPrice;
        public $imgList;
        
        const SP_SPEDITION = 0;
        const SP_HANDTAKE = 1;
        const SP_TDB = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lotteries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, lottery_type, prize_desc, prize_category, ticket_value, lottery_start_date, prize_price', 'required'),
			array('lottery_type, prize_category, min_ticket, max_ticket, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('ticket_value, prize_price', 'numerical'),
			array('name', 'length', 'max'=>45),
			array('prize_conditions, prize_shipping', 'length', 'max'=>155),
			array('lottery_draw_date, created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, lottery_type, prize_desc, prize_category, prize_conditions, prize_shipping, prize_price, min_ticket, max_ticket, ticket_value, lottery_start_date, lottery_draw_date, created, modified, last_modified_by', 'safe', 'on'=>'search'),
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
			'lotteryComments' => array(self::HAS_MANY, 'LotteryComments', 'lottery_id'),
			'tickets' => array(self::HAS_MANY, 'Tickets', 'lottery_id'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'category' => array(self::BELONGS_TO, 'PrizeCategories', 'prize_category'),
                        'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'lottery_type' => 'Lottery Type',
			'prize_desc' => 'Prize Desc',
			'prize_category' => 'Prize Category',
			'prize_conditions' => 'Prize Conditions',
			'prize_shipping' => 'Prize Shipping',
			'prize_price' => 'Prize Value',
			'ticket_value' => 'Ticket Value',
			'min_ticket' => 'Min Ticket',
			'max_ticket' => 'Max Ticket',
			'ticket_value' => 'Ticket Value',
			'lottery_start_date' => 'Lottery Start Date',
			'lottery_draw_date' => 'Lottery Draw Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lottery_type',$this->lottery_type);
		$criteria->compare('prize_desc',$this->prize_desc,true);
		$criteria->compare('prize_category',$this->prize_category);
		$criteria->compare('prize_conditions',$this->prize_conditions,true);
		$criteria->compare('prize_shipping',$this->prize_shipping,true);
		$criteria->compare('prize_price',$this->prize_price);
		$criteria->compare('ticket_value',$this->ticket_value);
		$criteria->compare('min_ticket',$this->min_ticket);
		$criteria->compare('max_ticket',$this->max_ticket);
		$criteria->compare('ticket_value',$this->ticket_value);
		$criteria->compare('lottery_start_date',$this->lottery_start_date,true);
		$criteria->compare('lottery_draw_date',$this->lottery_draw_date,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('last_modified_by',$this->last_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getLotteries($type)
	{
            $criteria=new CDbCriteria; 
            if(isset($type['my'])){
                $criteria->addCondition('owner_id='.Yii::app()->user->id);
            } 
            if(isset($type['status'])){
                /*if($type['status']==="active"){
                    $dbToday=new CDbExpression('NOW()');
                    $criteria->order='lottery_start_date';
                    $criteria->addCondition('is_active=1');
                    $criteria->addCondition('status=`active`');
                    $criteria->addCondition('lottery_start_date <='.$dbToday);
                    $criteria->addCondition('lottery_draw_date >='.$dbToday);
                }*/
                $criteria->addInCondition('status',$type['status']);
            }
            if(isset($type['prizeCategory'])){
                $criteria->addInCondition('prize_category',$type['prizeCategory']);
            }
                
            if(isset($type['tag']))
                $criteria->addSearchCondition('name',$type['tag']);
            
            if(isset($type['minDate']))
                $criteria->addCondition('t.lottery_start_date >="' .$type['minDate'].'"');
            
            if(isset($type['maxDate']))
                $criteria->addCondition('t.lottery_draw_date <="' .$type['maxDate'].'"');

            if(isset($type['minTicketPriceRange']))
                $criteria->addCondition('t.ticket_value >="' .$type['minTicketPriceRange'].'"');

            if(isset($type['maxTicketPriceRange']))
                $criteria->addCondition('t.ticket_value <="' .$type['maxTicketPriceRange'].'"');

            if(isset($type['minPrizePriceRange']))
                $criteria->addCondition('t.prize_price >="' .$type['minPrizePriceRange'].'"');

            if(isset($type['maxPrizePriceRange']))
                $criteria->addCondition('t.prize_price <="' .$type['maxPrizePriceRange'].'"');
            
            if(isset($type['searchText'])){
                $criteria->addCondition('t.name like "%' .$type['searchText'].'%" OR t.prize_desc like "%' .$type['searchText'].'%"');
            }


            $dataProvider=new CActiveDataProvider('Lotteries', array(
                'pagination'=>array(
                    'pageSize'=>20,
                ),
                'criteria'=>$criteria,
            ));
                
            return $dataProvider;
            
        }
        
        public function getPerc(){
            //if($this->lottery_type == Yii::app()->params['lotteryTypesConst']['fixTime']){
                return 1;
                $datetime1 = strtotime($this->lottery_start_date);
                $datetime2 = strtotime($this->lottery_draw_date);
                $datetime3 = strtotime(date("Y-m-d H:i:s"));

                $total=$datetime2-$datetime1;
                $part=$datetime2-$datetime3;
                $perc=$part*100/$total;// == <seconds between the two times>
                return $perc;
            //} elseif($this->lottery_type == Yii::app()->params['lotteryTypesConst']['fixTime']){
                
            //}
        }
        
        public function isFixTime(){
            return $this->lottery_type === Yii::app()->params['lotteryTypeConst']['fixTime'];
        }

        public function isLimTicket(){
            return $this->lottery_type === Yii::app()->params['lotteryTypeConst']['limTicket'];
        }
        
        public function getStatusText(){
            $statuses=Yii::app()->params['lotteryStatusConst'];
            foreach($statuses as $k=>$v){
                if($v===(int)$this->status){
                    return $k;
                }
            }
            return "";
        }
        
        public function getMaxTicketPrice(){
            $criteria=new CDbCriteria;
            $criteria->select='max(ticket_value) AS maxPrice';
            $row = $this->find($criteria);
            return $row['maxPrice'];
        }

        public function getMaxPrizePrice(){
            $criteria=new CDbCriteria;
            $criteria->select='max(prize_price) AS maxPrice';
            $row = $this->find($criteria);
            return $row['maxPrice'];
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lotteries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
