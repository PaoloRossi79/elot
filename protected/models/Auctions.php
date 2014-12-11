<?php

/**
 * This is the model class for table "auctions".
 *
 * The followings are the available columns in table 'auctions':
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
require_once Yii::getPathOfAlias('ext.PHPStats') .  DIRECTORY_SEPARATOR . 'PHPStats.phar';
class Auctions extends PActiveRecord
{
        public $maxPrice;
        public $imgList;
        public $cloneId;
        public $distance;
        
        const SP_SPEDITION = 0;
        const SP_HANDTAKE = 1;
        const SP_TDB = 2;
        
        const errorCredit = -1;
        const errorStatus = -2;
        const errorGuest = -3;
        const errorOwner = -4;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auctions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, lottery_type, prize_desc, prize_category, ticket_value, lottery_start_date, lottery_draw_date, prize_conditions', 'required'),
			array('lottery_type, prize_category, min_ticket, max_ticket, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('ticket_value, prize_price', 'numerical'),
			array('name, prize_condition_text', 'length', 'max'=>45),
			array('prize_shipping', 'length', 'max'=>155),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
//			array('id, name, lottery_type, prize_desc, prize_category, prize_conditions, prize_condition_text, prize_shipping, prize_price, min_ticket, max_ticket, ticket_value, lottery_start_date, lottery_draw_date, lottery_close_date, created, modified, last_modified_by', 'safe', 'on'=>'search'),
                        array('lottery_start_date', 'myCheckdate', 'compare'=>'lottery_draw_date', 'criteria'=>'smaller', 'on'=>'editSubmit'),
                        array('lottery_draw_date', 'myCheckdate', 'compare'=>'lottery_start_date', 'criteria'=>'bigger', 'on'=>'editSubmit'),
                        array('name, lottery_type, prize_desc, prize_category, prize_img, prize_conditions, prize_condition_text, prize_shipping, prize_price, min_ticket, max_ticket, ticket_value, lottery_start_date, lottery_draw_date, lottery_close_date, location_id, winning_id, winning_sum, winner_id', 'safe'),
		);
	}
        
        public function myCheckdate($attribute,$params) // $params: compare= attribute to compare, criteria= {bigger or smaller}
        {
            if(!$this->hasErrors())
            {
                $now = CDateTimeParser::parse(date("d/m/Y H:m:s"), Yii::app()->params['toDbDateTimeFormat']);
                $checkDate = CDateTimeParser::parse($this->{$attribute}, Yii::app()->params['toDbDateTimeFormat']);
                if($checkDate < $now)
                {
                    $this->addError($attribute,Yii::t('wonlot','La data non è valida (passata)'));
                }
                if($params['compare'] && $params['criteria']){
                    $compareDate = CDateTimeParser::parse($this->{$params['compare']}, Yii::app()->params['toDbDateTimeFormat']);
                    if($params['criteria'] == "bigger"){
                        if($checkDate < $compareDate)
                        {
                            $this->addError($attribute,Yii::t('wonlot','La data di chiusura è minore di quella di apertura'));
                        }
                        // check for max lenght of auction: 2 HR min, 30 days max
                        $diff = $checkDate - $compareDate;
                        if($diff < (60 *60 * 2)){
                            $this->addError($attribute,Yii::t('wonlot','La durata dell\'asta è inferiore alle 2 ore'));
                        } elseif($diff > (60 * 60 * 24 * 30)){
                            $this->addError($attribute,Yii::t('wonlot','La durata dell\'asta è superiore a 30 giorni'));
                        }
                    } elseif($params['criteria'] == "smaller"){
//                        if(strtotime($this->{$attribute}) > strtotime($this->{$params['compare']}))
                        if($checkDate > $compareDate)
                        {
                            $this->addError($attribute,Yii::t('wonlot','La data di apertura è maggiore di quella di chiusura'));
                        }
                    }
                }
            }
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
			'validTickets' => array(self::HAS_MANY, 'Tickets', 'lottery_id', 'condition'=>'validTickets.status = 1'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'winningUser' => array(self::BELONGS_TO, 'Users', 'winning_id'),
			'winner' => array(self::BELONGS_TO, 'Users', 'winner_id'),
			'winnerTicket' => array(self::BELONGS_TO, 'Tickets', 'winner_ticket_id'),
			'category' => array(self::BELONGS_TO, 'PrizeCategories', 'prize_category'),
                        'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
                        'paidInfo' => array(self::BELONGS_TO, 'LotteryPaymentRequest', 'paid_ref_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('wonlot','ID'),
			'name' => Yii::t('wonlot','Nome'),
			'lottery_type' => Yii::t('wonlot','Tipo di Asta'),
			'prize_desc' => Yii::t('wonlot','Descrizione del premio'),
			'prize_category' => Yii::t('wonlot','Categoria del premio'),
			'prize_conditions' => Yii::t('wonlot','Condizioni del premio'),
			'prize_condition_text' => Yii::t('wonlot','Testo Condizioni del premio'),
			'prize_shipping' => Yii::t('wonlot','Spedizione del premio'),
			'prize_price' => Yii::t('wonlot','Valore del premio'),
			'ticket_value' => Yii::t('wonlot','Valore del ticket'),
			'min_ticket' => Yii::t('wonlot','Min Ticket'),
			'max_ticket' => Yii::t('wonlot','Max Ticket'),
			'lottery_start_date' => Yii::t('wonlot','Data di inizio della Asta'),
			'lottery_draw_date' => Yii::t('wonlot','Data di estrazione della Asta'),
			'created' => Yii::t('wonlot','Creata'),
			'modified' => Yii::t('wonlot','Modificata'),
			'last_modified_by' => Yii::t('wonlot','Ultima modifica di'),
			'lot_location' => Yii::t('wonlot','Città o Indirizzo'),
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
		$criteria->compare('prize_condition_text',$this->prize_condition_text,true);
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
        
        public static function getMainAuctions()
	{
            $criteria=new CDbCriteria; 
            $criteria->addInCondition('status',array(3,2,4,5));
            $criteria->order = "FIELD(t.status, 3,2,4,5)";
            $dataProvider=new CActiveDataProvider('Auctions', array(
                /*'pagination'=>array(
//                    'pageSize'=>8,
                ),*/
                'criteria'=>$criteria,
            ));
                
            return $dataProvider;
        }
        
        public function getAuctions($type,$returnType="")
	{
            $criteria=new CDbCriteria; 
            if(isset($type['my']) && $type['my']){
                $criteria->addCondition('owner_id='.Yii::app()->user->id);
                $criteria->order = "FIELD(t.status, 3,2,1,4,5,6)";
            } else {
                $criteria->order = "FIELD(t.status, 3,2,4,5)";
            }
            if(isset($type['status'])){
                if($type['status']==="active"){
                    $dbToday=new CDbExpression('NOW()');
                    $criteria->order='lottery_start_date';
                    $criteria->addCondition('status='.Yii::app()->params['lotteryStatusConst']['open']);
                    $criteria->addCondition('lottery_start_date <='.$dbToday);
                    $criteria->addCondition('lottery_draw_date >='.$dbToday);
                } else {
                    //$criteria->order = "FIELD(t.status, 3,2,4,5)";
                }
                if(!is_array($type['status'])){
                    $status=array($type['status']);
                } else {
                    $status=$type['status'];
                }
                $criteria->addInCondition('status',$status);
            } else {
                if(!isset($type['my']) || !$type['my']){
                    $criteria->addNotInCondition('status',array(Yii::app()->params['lotteryStatusConst']['void']));
                }
            }
            if(isset($type['prizeCategory'])){
                if(!is_array($type['prizeCategory'])){
                    $cat=array($type['prizeCategory']);
                } else {
                    $cat=$type['prizeCategory'];
                }
                $criteria->addInCondition('prize_category',$cat);
            }
                
            if(isset($type['tag']))
                $criteria->addSearchCondition('name',$type['tag']);
            
            if(isset($type['minDate']))
                $criteria->addCondition('t.lottery_start_date >="' .$type['minDate'].'"');
            
            if(isset($type['maxDate']))
                $criteria->addCondition('t.lottery_draw_date <="' .$type['maxDate'].'"');
            
            if(isset($type['startDate']))
                $criteria->addCondition('t.lottery_start_date ="' .$type['startDate'].'"');
            
            if(isset($type['endDate']))
                $criteria->addCondition('t.lottery_draw_date ="' .$type['endDate'].'"');

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
            if(isset($type['name'])){
                $criteria->addCondition('t.name like "%' .$type['name'].'%"');
            }
            if(isset($type['prize_desc'])){
                $criteria->addCondition('t.prize_desc like "%' .$type['name'].'%"');
            }
            if(isset($type['favorite'])){
                $myFavLot = CHtml::listData(FavoriteLottery::model()->findAll('t.user_id ='.Yii::app()->user->id.' AND t.active=1'), 'lottery_id', 'lottery_id');
                if(!empty($myFavLot)){
                    $criteria->addInCondition('id',$myFavLot);
                }
            }
            if(isset($type['userGuaranted'])){
                $guarantedUsers = CHtml::listData(Users::model()->findAll('t.is_guaranted_seller = 1'), 'id', 'id');
                if(!empty($guarantedUsers)){
                    $criteria->addInCondition('owner_id',$guarantedUsers);
                }
            }
            if(isset($type['userMinRating'])){
                $ratedUsers = CHtml::listData(Users::model()->findAll('t.seller_rating >= '.$type['userMinRating']), 'id', 'id');
                if(!empty($ratedUsers)){
                    $criteria->addInCondition('owner_id',$ratedUsers);
                }
            }
            if(isset($type['geo'])){
                $unit = 6371;   
                $criteria->select = '* ,( '.$unit.' * acos( cos( radians('.$type['geo']['lat'].' )) * cos( radians( location.addressLat ) ) * cos( radians( location.addressLng ) - radians('.$type['geo']['lng'].') ) + sin( radians('.$type['geo']['lat'].') ) * sin( radians( location.addressLat ) ) ) ) AS distance';
                $criteria->with = array('location');
                $criteria->order='distance';
            }
            
            if($returnType == "pager"){
                $total = Auctions::model()->count($criteria);

                $pages = new CPagination($total);
                $pages->pageSize = 5;
                $pages->applyLimit($criteria);

                $lots = Auctions::model()->findAll($criteria);

                return array('auctions'=>$lots,'pages'=>$pages);
            } else {
                $dataProvider=new CActiveDataProvider('Auctions', array(
                    'pagination'=>array(
                        'pageSize'=>8,
                    ),
                    'criteria'=>$criteria,
                ));

                return $dataProvider;
            }
            
        }
        
        public function checkNewStatus(){
            if($this->status == Yii::app()->params['lotteryStatusConst']['open']){
                if($this->prize_price && $this->ticket_sold_value >= $this->prize_price){
                    $this->status = Yii::app()->params['lotteryStatusConst']['closed'];
//                    $this->lottery_close_date = date('Y-m-d H:i:s');
                    $this->lottery_close_date = new CDbExpression("NOW()");
                    if($this->saveAttributes(array('status','lottery_close_date'))){
//                    if($this->save()){
//                        $emailRes=EmailManager::sendCloseLottery($this);
                        return Yii::app()->params['lotteryStatusConst']['closed'];
                    } else {
                        // send error email to ADMIN
                        Yii::log("Lottery not close: Id=".$this->id.", name=".$this->name, "error");
                        foreach ($this->getErrors() as $err){
                            foreach ($err as $e){
                                Yii::log("Error: ".$e, "error");
                            }
                        }
//                        $emailRes=EmailManager::sendAdminEmail($this,'closing lottery');
                    }
                } else {
                    return false;
                }
            } else {
                Yii::log("CheckNewStatus on invalid lottery status: status=".$this->status,"error");
            }            
        }
        public function checkNewStatus2(){
            if($this->status == Yii::app()->params['lotteryStatusConst']['open']){
                if($this->ticket_sold_value > $this->prize_price){
                    $this->status = Yii::app()->params['lotteryStatusConst']['closed'];
                    if($this->save()){
                        // send email for lottery closure
                    } else {
                        // send error email to ADMIN
                    }
                }
                if($this->lottery_draw_date > new CDbExpression('NOW()')){
                    $this->status = Yii::app()->params['lotteryStatusConst']['closed'];
                    if($this->save()){
                        // send email for lottery closure
                    } else {
                        // send error email to ADMIN
                    }
                }
            } elseif($this->status == Yii::app()->params['lotteryStatusConst']['upcoming']){
                if($this->lottery_start_date > new CDbExpression('NOW()')){
                    $this->status = Yii::app()->params['lotteryStatusConst']['open'];
                    if($this->save()){
                        // do nothing for now
                    } else {
                        // send error email to ADMIN
                    }
                }
            } elseif($this->status == Yii::app()->params['lotteryStatusConst']['closed']){
                // manage extraction...
                if(false){ // if(has not been extracted yet...) 
                    // doExtraction
                    /* 
                    $extResult = $this->extractLottery(); //track winners -> email to winners
                    if($extResult){
                        $this->status = Yii::app()->params['lotteryStatusConst']['extracted'];
                        // -> update tickets ... maybe use transactions
                        if($this->save()){
                            // do nothing for now
                        } else {
                            // send error email to ADMIN
                        }
                    }
                    */
                }
            }    
            
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
        
        public function getStatusText($status=null){
            $statuses=Yii::app()->params['lotteryStatusConst'];
            $textStatuses=Yii::app()->params['lotteryStatusConstIta'];
            if($status != null){
                if($status instanceof Auctions){
                    $checkStatus = (int)$status->status;
                } else {
                    $checkStatus = (int)$status;
                }
            } else {
                $checkStatus = (int)$this->status;
            }
            foreach($statuses as $k=>$v){
                if($v===$checkStatus){
                    return $textStatuses[$k];
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
        
        public function getBoughtLotMenu(){
            $criteria=new CDbCriteria;
            $criteria->addCondition('tickets.user_id = '.Yii::app()->user->id);
            $criteria->group='tickets.lottery_id';
            $row = $this->with(array('tickets'))->findAll($criteria);
            $menu = array();
            foreach ($row as $l) {
                $menu[] = array('id' => $l->id, 'name' => $l->name);
            }
            
            return $menu;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your PActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auctions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	public static function genRandomTicketSerial()
	{
		return rand(100000,999999);
	}
        
        public function updateWinning2(){
            $res = array('isWinning'=>false,'newWinner' => false);
            
            return $res;
        }
        public function updateWinning(){
            $res = array('isWinning'=>false,'newWinner' => false);
            if(count($this->validTickets)>0){
                /*$dbCommand = Yii::app()->db->createCommand("
                    SELECT lottery_id,user_id,SUM(random_weight) as sumweight FROM `tickets` WHERE lottery_id = ".$this->id." GROUP BY `user_id`
                ");*/
                
                $dbCommand = Yii::app()->db->createCommand("
                    SELECT lottery_id,user_id,SUM(random_weight) as sumweight 
                    FROM `tickets` 
                    WHERE lottery_id = ".$this->id.
                    " AND user_id != 0
                      AND status = 1 GROUP BY `user_id`
                ");

                $data = $dbCommand->queryAll();
                $reduced=array();
                foreach ($data as $group) {
                    $res['actWinnerValue'] = $this->winning_sum;
                    if($group['sumweight'] > $this->winning_sum){
                        $res['isWinning'] = true;
                        $this->winning_sum = $group['sumweight'];
                        if($group['user_id'] != $this->winning_id){
                            $this->winning_id = $group['user_id'];
                            $res['newWinner'] = true;
                            $res['newWinnerValue'] = $group['sumweight'];
                            $res['newWinnerUser'] = $group['user_id'];
                            $this->save();
                            // Notification to all players
//                            Notifications::sendNewWinningToAll($this);
                        } else { //same user as before
                            $res['actWinnerValue'] = $this->winning_sum;
                            $this->save();
                            // Notification to already winning user
//                            Notifications::sendSameWinningToUser($this);
                        }
                    }
                }
            }
            return $res;
        }
        
        public function checkToOpen(&$errors){
            // check upcoming to open
            $upCriteria = new CDbCriteria();
            $upCriteria->addCondition('t.status='.Yii::app()->params['lotteryStatusConst']['upcoming']);
            $upCriteria->addCondition('t.lottery_start_date <= '.new CDbExpression("NOW()"));
            $upChange = Auctions::model()->findAll($upCriteria);
            Yii::log("CRON 0", "warning");
            foreach($upChange as $up){
                Yii::log("CRON 1", "warning");
                //send email for opening
                $emailRes=EmailManager::sendOpenLottery($up);
                if(!$emailRes){
                    Yii::log("Err sending email: ".$emailRes, "error");
                } else {
                    $up->is_sent_open = 1;
                }
                $up->status = Yii::app()->params['lotteryStatusConst']['open'];
//                $up->is_active = 1;
                if($up->save(false)){
                    Yii::log("Lottery open: Id=".$up->id.", name=".$up->name, "warning");
                } else {
                    Yii::log("Lottery not open: Id=".$up->id.", name=".$up->name, "error");
                    $errors['open'][$up->id]=array();
                    foreach ($up->getErrors() as $err){
                        foreach ($err as $e){
                            Yii::log("Error: ".$e, "error");
                            $errors['open'][$up->id][]=$e;
                        }
                    }
                }
            }
        }
        
        public function checkToClose(&$errors){
            // check upcoming / open to close
            $closeCriteria = new CDbCriteria();
            $closeCriteria->addInCondition('t.status',array(Yii::app()->params['lotteryStatusConst']['upcoming'],Yii::app()->params['lotteryStatusConst']['open']));
            $closeCriteria->addCondition('t.lottery_draw_date <= '.new CDbExpression("NOW()"));
            $closeChange = Auctions::model()->findAll($closeCriteria);
            foreach($closeChange as $close){
                //send email for opening
                $emailRes=EmailManager::sendCloseLottery($close);
                if(!$emailRes){
                    Yii::log("Err sending email: ".$emailRes, "error");
                } else {
                    $close->is_sent_close = 1;
                }
                $close->status = Yii::app()->params['lotteryStatusConst']['closed'];
                $close->lottery_close_date = new CDbExpression('NOW()');
                $close->winner_id = $close->winning_id;                
                if($close->save(false)){
                    $closeLottery = $this->findByPk($close->id);
                    Yii::log("Lottery close: Id=".$closeLottery->id.", name=".$closeLottery->name, "warning");
                    //send email for opening
                    $emailRes=EmailManager::sendExtractLotteryToWinner($closeLottery);
                    Notifications::model()->sendExtractLotteryToWinnerNotify($closeLottery);
                    $closeLottery->is_sent_extracted = 1;
                    if(!$emailRes){
                        Yii::log("Err sending email: ".$emailRes, "error");
                    } else {
                        $closeLottery->is_sent_extracted *= 2;
                    }
                    $emailRes=EmailManager::sendExtractLotteryToOwner($closeLottery);
                    Notifications::model()->sendExtractLotteryToOwnerNotify($closeLottery);
                    if(!$emailRes){
                        Yii::log("Err sending email: ".$emailRes, "error");
                    } else {
                        $closeLottery->is_sent_extracted *= 3;
                    }
                    if($closeLottery->is_sent_extracted > 1){
                        $closeLottery->save(false);
                    }
                } else {
                    Yii::log("Lottery not close: Id=".$close->id.", name=".$close->name, "error");
                    $errors['close'][$close->id]=array();
                    foreach ($close->getErrors() as $err){
                        foreach ($err as $e){
                            Yii::log("Error: ".$e, "error");
                            $errors['close'][$close->id][]=$e;
                        }
                    }
                }
            }
            
            // check for already closed but not sent email
            $alCloseCriteria = new CDbCriteria();
            $alCloseCriteria->addCondition('t.status='.Yii::app()->params['lotteryStatusConst']['closed']);
            $alCloseCriteria->addCondition('t.is_sent_close = 0');
            $alCloseChange = Auctions::model()->findAll($alCloseCriteria);
            foreach($alCloseChange as $close){
                Yii::log("CRON Al closed =".$close->id, "warning");
                //send email for opening
                $emailRes=EmailManager::sendCloseLottery($close);
                if(!$emailRes){
                    Yii::log("Err sending email: ".$emailRes, "error");
                } else {
                    $close->is_sent_close = 1;
                }
                if($close->save(false)){
                    $closeLottery = $this->findByPk($close->id);
                    Yii::log("Lottery close: Id=".$closeLottery->id.", name=".$closeLottery->name, "warning");
                    //send email for opening
                    $emailRes=EmailManager::sendExtractLotteryToWinner($closeLottery);
                    Notifications::model()->sendExtractLotteryToWinnerNotify($closeLottery);
                    $closeLottery->is_sent_extracted = 1;
                    if(!$emailRes){
                        Yii::log("Err sending email: ".$emailRes, "error");
                    } else {
                        $closeLottery->is_sent_extracted *= 2;
                    }
                    $emailRes=EmailManager::sendExtractLotteryToOwner($closeLottery);
                    Notifications::model()->sendExtractLotteryToOwnerNotify($closeLottery);
                    if(!$emailRes){
                        Yii::log("Err sending email: ".$emailRes, "error");
                    } else {
                        $closeLottery->is_sent_extracted *= 3;
                    }
                    if($closeLottery->is_sent_extracted > 1){
                        $closeLottery->save(false);
                    }
                    Yii::log("Lottery close EMAIL: Id=".$closeLottery->id.", name=".$closeLottery->name, "warning");
                } else {
                    Yii::log("Lottery not close EMAIL: Id=".$close->id.", name=".$close->name, "error");
                    $errors['close'][$close->id]=array();
                    foreach ($close->getErrors() as $err){
                        foreach ($err as $e){
                            Yii::log("Error: ".$e, "error");
                            $errors['close'][$close->id][]=$e;
                        }
                    }
                }
            }
        }
        
        public function checkToExtract(&$errors){
            // check close to extracted
            $extractCriteria = new CDbCriteria();
            $extractCriteria->addCondition('t.status = '.Yii::app()->params['lotteryStatusConst']['closed']);
            $extractCriteria->addCondition('t.lottery_close_date <= '.new CDbExpression("NOW() - INTERVAL 1 HOUR"));
            $extractChange = Auctions::model()->findAll($extractCriteria);
            foreach($extractChange as $extract){
                Yii::log("Extraction: lottery=".$extract->id, "warning");
                $winner=null;
                $winnerTicket=null;
                $criteria=new CDbCriteria; 
                $criteria->addCondition('lottery_id='.$extract->id);
                $criteria->addCondition('status=1');
                $criteria->addCondition('user_id!='.$extract->owner_id);
                $lotteryTickets = Tickets::model()->findAll($criteria);
                if($lotteryTickets){
                    // extract winner
                    $winnerId=rand(0, count($lotteryTickets)-1);
                    $checkWinner=true;
                    while ($checkWinner){ 
                        if(count($lotteryTickets) == 0){
                            break;
                        }
                        $winner=$lotteryTickets[$winnerId];
                        if($winner){
                            $checkForWinnerUser = (!empty($winner->user_id) && isset($winner->user) && $winner->user->is_active);
                            if($checkForWinnerUser){
                                //winner FOUND
                                $checkWinner=false;
                                $winnerTicket=$winner;
                            } else {
                                array_splice($lotteryTickets, $winnerId, 1);
                                $winnerId=rand(0, count($lotteryTickets)-1);
                            }
                        } else {
                            $winnerId=rand(0, count($lotteryTickets)-1);
                        }
                    }
                    if($winnerTicket){
                        $extract->status = Yii::app()->params['lotteryStatusConst']['extracted'];
                        $extract->lottery_extract_date = new CDbExpression('NOW()');
                        $extract->winner_id = $winnerTicket->user_id;
                        $extract->winner_ticket_id = $winnerTicket->id;
                        $extract->is_sent_extracted = 1;
                        if($extract->save(false)){
                            Yii::log("Lottery extract: Id=".$extract->id.", name=".$extract->name, "warning");
                            //send email for opening
                            $emailRes=EmailManager::sendExtractLotteryToWinner($extract,$winnerTicket);
                            Notifications::model()->sendExtractLotteryToWinnerNotify($extract,$winnerTicket);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            } else {
                                $extract->is_sent_extracted *= 2;
                            }
                            $emailRes=EmailManager::sendExtractLotteryToOwner($extract,$winnerTicket);
                            Notifications::model()->sendExtractLotteryToOwnerNotify($extract);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            } else {
                                $extract->is_sent_extracted *= 3;
                            }
                            if($extract->is_sent_extracted > 1){
                                $extract->save(false);
                            }
                        } else {
                            Yii::log("Lottery not extract: Id=".$extract->id.", name=".$extract->name, "error");
                            $errors['extract'][$extract->id]=array();
                            foreach ($extract->getErrors() as $err){
                                foreach ($err as $e){
                                    Yii::log("Error: ".$e, "error");
                                    $errors['extract'][$extract->id][]=$e;
                                }
                            }
                        }
                    } else {
                        $extract->status = Yii::app()->params['lotteryStatusConst']['void'];
                        if($extract->save(false)){
                            Yii::log("Lottery void: Id=".$extract->id.", name=".$extract->name, "warning");
                            //send email for opening
                            $emailRes=EmailManager::sendVoidLotteryToOwner($extract);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            }
                        }
                    }
                } else {
                    Yii::log("No tickets: lottery=".$extract->id, "warning");
                    $extract->status = Yii::app()->params['lotteryStatusConst']['void'];
                    if($extract->save(false)){
                        Yii::log("Lottery void: Id=".$extract->id.", name=".$extract->name, "warning");
                        //send email for opening
                        $emailRes=EmailManager::sendVoidLotteryToOwner($extract);
                        if(!$emailRes){
                            Yii::log("Err sending email: ".$emailRes, "error");
                        }
                    }
                }
            }
        }
        
        public function checkToVoid(&$errors){
            // check for already voided but not sent email
            $voidCriteria = new CDbCriteria();
            $voidCriteria->addCondition('t.status='.Yii::app()->params['lotteryStatusConst']['void']);
            $voidCriteria->addCondition('t.is_sent_void = 0');
            $voidChange = Auctions::model()->findAll($voidCriteria);
            foreach($voidChange as $void){
                Yii::log("CRON Void =".$void->id, "warning");
                //send email for voided
                $emailRes=EmailManager::sendVoidLotteryToOwner($void);
                // TODO: valutare se aggiungere email a singolo utente per rimborso ticket
                if(!$emailRes){
                    Yii::log("Err sending email: ".$emailRes, "error");
                } else {
                    $void->is_sent_void = 1;
                }
                if($void->save(false)){
                    Yii::log("Lottery void EMAIL: Id=".$void->id.", name=".$void->name, "warning");
                } else {
                    Yii::log("Lottery void EMAIL error: Id=".$void->id.", name=".$void->name, "error");
                    $errors['void'][$void->id]=array();
                    foreach ($void->getErrors() as $err){
                        foreach ($err as $e){
                            Yii::log("Error: ".$e, "error");
                            $errors['void'][$void->id][]=$e;
                        }
                    }
                }
            }
        }
        
        public function sendTicketsEmail(&$errors){
            $crit = new CDbCriteria();
            $crit->with=array("tickets"=>array(
                // but want to get only users with published posts
                'joinType'=>'INNER JOIN',
                'condition'=>'tickets.status = 1 AND tickets.is_sent = 0 AND tickets.is_gift is null',
            ));
            $usersTickets = Users::model()->findAll($crit);
            $usersTickets = array_slice($usersTickets, 0, 10);
            foreach($usersTickets as $user){
                try {
                    Yii::log("Ticket to send: ".count($user->tickets)." to: ".$user->email,"warning");
                    if(count($user->tickets) > 0){
                        $res=EmailManager::model()->sendTickets($user);
                        if($res){
                            foreach($user->tickets as $ticket){
                                $ticket->is_sent = 1;
                                if(!$ticket->save()){
                                    Yii::log("UPD Sending tickets error: ".$ticket->id,'error');
                                    $errors['tickets'][]="UPD after Sending tickets error: ".$ticket->id;
                                }
                            }
                        } else {
                            Yii::log("Sending tickets error: ".$ticket->id,'error');
                            $errors['tickets'][]="Sending tickets error: user ".$user->id;
                        }
                    }
                } catch (Exception $exc) {
                    Yii::log($exc->getTraceAsString(),'error');
                    $errors['tickets'][]="Sending tickets error: user ".$user->id;
                }
            }
        }
        
        public function sendGiftTicketsEmail(&$errors){
            $crit = new CDbCriteria();
            $crit->addCondition('t.status = 1');
            $crit->addCondition('t.is_sent = 0');
            $crit->addCondition('t.is_gift = 1');
            $crit->addCondition('t.gift_provider = "email"');
            $tickets = Tickets::model()->findAll($crit);
            $groupTicket = Tickets::model()->organizeTicketsByEmail($tickets);
            foreach($groupTicket as $gt){
                try {
                    $res=EmailManager::model()->sendGiftTicketsToExt($gt);
                    if($res){
                        foreach($gt['auctions'] as $lot){
                            foreach($lot['tickets'] as $ticket){
                                $ticket->is_sent = 1;
                                if(!$ticket->save()){
                                    Yii::log("UPD Sending tickets error: ".$ticket->id,'error');
                                    $errors['giftTickets'][]="UPD after Sending giftTickets error: ".$ticket->id;
                                }
                            }
                        }
                    } else {
                        Yii::log("Sending tickets error: ".$ticket->id,'error');
                        $errors['giftTickets'][]="Sending giftTickets error: user ".$gt['email'];
                    }
                } catch (Exception $exc) {
                    Yii::log($exc->getTraceAsString(),'error');
                    $errors['giftTickets'][]="Sending giftTickets error: user ".$gt['email'];
                }
            }
            $usersTickets = null;
            $crit = new CDbCriteria();
            $crit->with=array("tickets"=>array(
                // but want to get only users with published posts
                'joinType'=>'INNER JOIN',
                'condition'=>'tickets.status = 1 AND tickets.is_sent = 0 AND tickets.is_gift = 1 AND tickets.user_id != tickets.gift_from_id',
            ));
            $usersTickets = Users::model()->findAll($crit);
            $usersTickets = array_slice($usersTickets, 0, 10);
            foreach($usersTickets as $user){
                try {
                    if(count($user->tickets) > 0){
                        $res=EmailManager::model()->sendGiftTickets($user);
                        if($res){
                            foreach($user->tickets as $ticket){
                                $ticket->is_sent = 1;
                                if(!$ticket->save()){
                                    Yii::log("UPD Sending tickets error: ".$ticket->id,'error');
                                    $errors['giftTickets'][]="Sending giftTickets error: ".$ticket->id;
                                }
                            }
                        } else {
                            Yii::log("Sending tickets error: ".$ticket->id,'error');
                            $errors['giftTickets'][]="Sending giftTickets error: user ".$user->id;
                        }
                    }
                } catch (Exception $exc) {
                    Yii::log($exc->getTraceAsString(),'error');
                    $errors['giftTickets'][]="Sending giftTickets error: user ".$user->id;
                }
            }
        }
        
        public function getMyFavoriteAuctions(){
            $userId = Yii::app()->user->id;
            if(!$userId){
                return array();
            }
            $crit = new CDbCriteria();
            $crit->select = 't.lottery_id';
            $crit->addCondition('t.user_id = '.$userId);
            $crit->addCondition('t.active = 1');
            $favLots = FavoriteLottery::model()->findAll($crit);
//            $favArr = CHtml::listData( $favLots, 'id','lottery_id');
            $favArr = CHtml::listData( $favLots, 'lottery_id','lottery_id');
            return $favArr;
        }
}
