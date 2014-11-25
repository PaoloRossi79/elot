<?php

/**
 * This is the model class for table "tickets".
 *
 * The followings are the available columns in table 'tickets':
 * @property string $id
 * @property integer $user_id
 * @property integer $lottery_id
 * @property integer $serial_number
 * @property double $price
 * @property double $value
 * @property string $promotion_id
 * @property string $created
 * @property string $modified
 * @property integer $last_modified_by
 */
class Tickets extends PActiveRecord
{
        public $filterModel;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tickets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, lottery_id, serial_number, price, value', 'required'),
			array('user_id, lottery_id, serial_number, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('price, value', 'numerical'),
			array('promotion_id', 'length', 'max'=>10),
			array('created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, lottery_id, serial_number, price, value, promotion_id, created, modified, last_modified_by', 'safe', 'on'=>'search'),
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
                    'giftFromUser' => array(self::BELONGS_TO, 'Users', 'gift_from_id'),
                    'lottery' => array(self::BELONGS_TO, 'Lotteries', 'lottery_id'),
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
			'lottery_id' => Yii::t('wonlot','Lottery'),
			'serial_number' => Yii::t('wonlot','Serial Number'),
			'price' => Yii::t('wonlot','Price'),
			'value' => Yii::t('wonlot','Value'),
			'promotion_id' => Yii::t('wonlot','Promotion'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('lottery_id',$this->lottery_id);
		$criteria->compare('serial_number',$this->serial_number);
		$criteria->compare('price',$this->price);
		$criteria->compare('value',$this->value);
		$criteria->compare('promotion_id',$this->promotion_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('last_modified_by',$this->last_modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getMyTicketsNumberAllLotteries()
	{
            $dbCommand = Yii::app()->db->createCommand("
                SELECT lottery_id,COUNT(*) as count FROM `tickets` WHERE user_id = ".Yii::app()->user->id." GROUP BY `lottery_id`
            ",array('userId' => Yii::app()->user->id));

            $data = $dbCommand->queryAll();
            $reduced=array();
            foreach ($data as $pair) {
                $reduced[$pair['lottery_id']]=$pair['count'];
            }
            return $reduced;
        }
        
        public function getMyTicketsNumberByLottery($lotId)
	{
            $dbCommand = Yii::app()->db->createCommand("
                SELECT COUNT(*) as count FROM `tickets` 
                WHERE user_id = ".Yii::app()->user->id." 
                AND lottery_id = ".$lotId);

            $data = $dbCommand->queryAll();
            
            return $data[0]['count'];
        }
        
        public function getMyTotalForLottery($lotId)
	{            
            $dbCommand = Yii::app()->db->createCommand("
                SELECT lottery_id,user_id,SUM(random_weight) as sumweight 
                FROM `tickets` 
                WHERE lottery_id = ".$lotId.
                    " AND user_id = ".Yii::app()->user->id.
                    " AND status = 1 GROUP BY `user_id`
            ");

            $data = $dbCommand->queryAll();
            return $data[0]['sumweight'];
        }
        
        public function getMyTicketsByLottery($lotId)
	{
            $criteria=new CDbCriteria; 
            $criteria->addCondition('t.user_id = '.Yii::app()->user->id,'OR'); 
            $criteria->addCondition('t.gift_from_id = '.Yii::app()->user->id,'OR'); 
            $criteria->addCondition('t.lottery_id = '.$lotId,'AND'); 
            $criteria->addCondition('t.status = 1','AND'); 
            return $this->findAll($criteria);
        }
        
        public function getMyGiftTicketsByLottery($lotId)
	{
            $criteria=new CDbCriteria; 
            $criteria->addCondition('t.lottery_id = '.$lotId); 
            $criteria->addCondition('t.user_id = '.Yii::app()->user->id); 
            $criteria->addCondition('t.is_gift = 1'); 
            $criteria->addCondition('t.gift_from_id != '.Yii::app()->user->id); 
            $criteria->addCondition('t.status = 1'); 
            return $this->findAll($criteria);
        }
        
        public function getMyTickets($post){
            $viewData=array();
            $criteria=new CDbCriteria(); 
            if(!empty($post['SearchForm']['Categories'])){
                $criteria->addInCondition('t.prize_category',$post['SearchForm']['Categories']);
                $result['viewData']['showCat']=$post['SearchForm']['Categories'];
            }
            if(!empty($post['SearchForm']['LotStatusComplete'])){
                $statusOptions = $post['SearchForm']['LotStatusComplete'];
                $first = true;
                $filter['status'] = array();
                foreach($statusOptions as $opt) {
                    $filter['status'] = array_merge($filter['status'],array(Yii::app()->params['lotteryStatusConst'][$opt])); 
                    $result['viewData']['showStatus'].=($first?"":", ").Yii::app()->params['lotteryStatusConstIta'][$opt];
                    $first=false;
                }
                $criteria->addInCondition('t.status',$filter['status']);
            }
            if(!empty($post['SearchForm']['searchStartDate'])){
                $minDate=Yii::app()->dateFormatter->format('dd-MM-yyyy',$post['SearchForm']['searchStartDate']);
                $criteria->addCondition('t.lottery_start_date >="' .$minDate.'"');
            }
            if(!empty($post['SearchForm']['searchEndDate'])){
                $maxDate=Yii::app()->dateFormatter->format('dd-MM-yyyy',$post['SearchForm']['searchEndDate']);
                $criteria->addCondition('t.lottery_draw_date <="' .$maxDate.'"');
            }
            if(!empty($post['SearchForm']['lottery_start_date'])){
                $startDate=Yii::app()->dateFormatter->format('dd-MM-yyyy',$post['SearchForm']['lottery_start_date']);
                $criteria->addCondition('t.lottery_start_date ="' .$startDate.'"');
            }
            if(!empty($post['SearchForm']['lottery_draw_date'])){
                $endDate=Yii::app()->dateFormatter->format('dd-MM-yyyy',$post['SearchForm']['lottery_draw_date']);
                $criteria->addCondition('t.lottery_draw_date ="' .$endDate.'"');
            }
            if(!empty($post['SearchForm']['minTicketPriceRange'])){
                $minTicketPriceRange=$post['SearchForm']['minTicketPriceRange'];
                $criteria->addCondition('t.ticket_value >="' .$minTicketPriceRange.'"');
            }
            if(!empty($post['SearchForm']['maxTicketPriceRange'])){
                $maxTicketPriceRange=$post['SearchForm']['maxTicketPriceRange'];
                $criteria->addCondition('t.ticket_value <="' .$maxTicketPriceRange.'"');
            }
            if($post['SearchForm']['searchText']){
                $sText=$post['SearchForm']['searchText'];
                $criteria->addCondition('t.name like "%' .$sText.'%" OR t.prize_desc like "%' .$sText.'%"');
            }
            
            $criteria->order='t.name';
            $criteria->with=array("tickets"=>array(
                // but want to get only users with published posts
                'joinType'=>'INNER JOIN',
                'condition'=>'tickets.user_id='.Yii::app()->user->id.' OR tickets.gift_from_id='.Yii::app()->user->id,
            ));
            $boughtLotteries = Lotteries::model()->findAll($criteria);
            return $boughtLotteries;
//            $this->renderPartial('_tickets',array(
//                'model'=>$boughtLotteries,
//                //'viewType'=>"_box"
//                'viewData'=>$viewData,
//            ));
        }
        
        public function getMyTicketsProvider(){
            $criteria=new CDbCriteria; 
            if($_POST['lotStatus']){
                $criteria->addCondition('t.status='.$_POST['lotStatus']);
                $viewData['lotStatus']=$_POST['lotStatus'];
            } else {
                $criteria->addNotInCondition('t.status',array(Yii::app()->params['lotteryStatusConst']['draft'],Yii::app()->params['lotteryStatusConst']['void']));
            }
            $criteria->order='t.name';
            $criteria->with=array("tickets"=>array(
                // but want to get only users with published posts
                'joinType'=>'INNER JOIN',
                'condition'=>'tickets.user_id='.Yii::app()->user->id.' OR tickets.gift_from_id='.Yii::app()->user->id,
            ));
            $boughtLotteries = Lotteries::model()->findAll($criteria);
            return new CActiveDataProvider('Lotteries', array(
                'criteria'=>$criteria,
            ));
//            $this->renderPartial('_tickets',array(
//                'model'=>$boughtLotteries,
//                //'viewType'=>"_box"
//                'viewData'=>$viewData,
//            ));
        }
        
        public function organizeTicketsByLottery($tickets){
            $res = array();
            foreach ($tickets as $ticket) {
                if(isset($res[$ticket->lottery->id])){
                    $res[$ticket->lottery->id]['tickets'][] = $ticket;
                } else {
                    $res[$ticket->lottery->id] = array('lottery'=>$ticket->lottery,'tickets'=>array());
                    $res[$ticket->lottery->id]['tickets'][] = $ticket;
                }
            }
            return $res;
        }
        
        public function organizeTicketsByEmail($tickets){
            $res = array();
            foreach ($tickets as $ticket) {
                if($ticket->is_gift == 1 && $ticket->gift_provider == "email" && $ticket->gift_ext_user){
                    if(isset($res[$ticket->gift_ext_user])){
                        if(isset($res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id])){
                            $res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id]['tickets'][] = $ticket;
                        } else {
                            $res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id] = array('lottery'=>$ticket->lottery,'tickets'=>array());
                            $res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id]['tickets'][] = $ticket;
                        }
                    } else {
                        $res[$ticket->gift_ext_user] = array('email'=>$ticket->gift_ext_user,'lotteries'=>array());
                        
                        $res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id] = array('lottery'=>$ticket->lottery,'tickets'=>array());
                        $res[$ticket->gift_ext_user]['lotteries'][$ticket->lottery->id]['tickets'][] = $ticket;
                    }
                }
            }
            return $res;
        }
        
        public static function getLotBoxTag($ticketId){
            $ticket = Tickets::model()->findByPk($ticketId);
            if($ticket){
                $res = "<span>";
                $url = "";
                $class = "img-thumbnail";
                $class .= " img-avatar";              
                $img = CHtml::image("/images/lotteries/".$ticket->lottery->id."/smallThumb/".$ticket->lottery->prize_img, "Lottery image", array("class"=>$class));
                $url = CHtml::link($img, Yii::app()->controller->createUrl('tickets/view/'.$ticketId));
                $res .= "<p>".$ticket->lottery->name;
                $res .= "</p>";
                $res .= $url;
                $res .= "</span>";
                return $res;
            } 
            return "";
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tickets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
