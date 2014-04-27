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
        public $cloneId;
        
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
			array('name, lottery_type, prize_desc, prize_category, ticket_value, lottery_start_date, lottery_draw_date, prize_conditions', 'required'),
			array('lottery_type, prize_category, min_ticket, max_ticket, last_modified_by', 'numerical', 'integerOnly'=>true),
			array('ticket_value, prize_price', 'numerical'),
			array('name, prize_condition_text', 'length', 'max'=>45),
			array('prize_shipping', 'length', 'max'=>155),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
//			array('id, name, lottery_type, prize_desc, prize_category, prize_conditions, prize_condition_text, prize_shipping, prize_price, min_ticket, max_ticket, ticket_value, lottery_start_date, lottery_draw_date, lottery_close_date, created, modified, last_modified_by', 'safe', 'on'=>'search'),
			array('name, lottery_type, prize_desc, prize_category, prize_img, prize_conditions, prize_condition_text, prize_shipping, prize_price, min_ticket, max_ticket, ticket_value, lottery_start_date, lottery_draw_date, location_id', 'safe',),
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
			'validTickets' => array(self::HAS_MANY, 'Tickets', 'lottery_id', 'condition'=>'validTickets.status = 1'),
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
			'prize_condition_text' => 'Prize Condition Text',
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
        
        public static function getMainLotteries()
	{
            $criteria=new CDbCriteria; 
            $criteria->addInCondition('status',array(3,4));
            $dataProvider=new CActiveDataProvider('Lotteries', array(
                /*'pagination'=>array(
//                    'pageSize'=>8,
                ),*/
                'criteria'=>$criteria,
            ));
                
            return $dataProvider;
        }
        
        public function getLotteries($type,$returnType="")
	{
            $criteria=new CDbCriteria; 
            if(isset($type['my'])){
                $criteria->addCondition('owner_id='.Yii::app()->user->id);
            } 
            if(isset($type['status'])){
                if($type['status']==="active"){
                    $dbToday=new CDbExpression('NOW()');
                    $criteria->order='lottery_start_date';
                    $criteria->addCondition('status=`active`');
                    $criteria->addCondition('lottery_start_date <='.$dbToday);
                    $criteria->addCondition('lottery_draw_date >='.$dbToday);
                }
                if(!is_array($type['status'])){
                    $status=array($type['status']);
                } else {
                    $status=$type['status'];
                }
                $criteria->addInCondition('status',$status);
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
            
            if($returnType == "pager"){
                $total = Lotteries::model()->count($criteria);

                $pages = new CPagination($total);
                $pages->pageSize = 5;
                $pages->applyLimit($criteria);

                $lots = Lotteries::model()->findAll($criteria);

                return array('lotteries'=>$lots,'pages'=>$pages);
            } else {
                $dataProvider=new CActiveDataProvider('Lotteries', array(
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
            if($status != null){
                if($status instanceof Lotteries){
                    $checkStatus = (int)$status->status;
                } else {
                    $checkStatus = (int)$status;
                }
            } else {
                $checkStatus = (int)$this->status;
            }
            foreach($statuses as $k=>$v){
                if($v===$checkStatus){
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
	 * @return Lotteries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	public static function genRandomTicketSerial()
	{
		return rand(100000,999999);
	}
        
        public function checkToOpen(&$errors){
            // check upcoming to open
            $upCriteria = new CDbCriteria();
            $upCriteria->addCondition('t.status='.Yii::app()->params['lotteryStatusConst']['upcoming']);
            $upCriteria->addCondition('t.lottery_start_date <= '.new CDbExpression("NOW()"));
            $upChange = Lotteries::model()->findAll($upCriteria);
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
                if($up->save()){
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
            $closeChange = Lotteries::model()->findAll($closeCriteria);
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
                if($close->save()){
                    Yii::log("Lottery close: Id=".$close->id.", name=".$close->name, "warning");
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
            $alCloseChange = Lotteries::model()->findAll($alCloseCriteria);
            foreach($alCloseChange as $close){
                Yii::log("CRON Al closed =".$close->id, "warning");
                //send email for opening
                $emailRes=EmailManager::sendCloseLottery($close);
                if(!$emailRes){
                    Yii::log("Err sending email: ".$emailRes, "error");
                } else {
                    $close->is_sent_close = 1;
                }
                if($close->save()){
                    Yii::log("Lottery close EMAIL: Id=".$close->id.", name=".$close->name, "warning");
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
            $extractChange = Lotteries::model()->findAll($extractCriteria);
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
                            $checkForWinnerUser = (!empty($winner->user_id) && $winner->user->is_active);
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
                        if($extract->save()){
                            Yii::log("Lottery extract: Id=".$extract->id.", name=".$extract->name, "warning");
                            //send email for opening
                            $emailRes=EmailManager::sendExtractLotteryToWinner($extract,$winnerTicket);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            } else {
                                $extract->is_sent_extracted *= 2;
                            }
                            $emailRes=EmailManager::sendExtractLotteryToOwner($extract,$winnerTicket);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            } else {
                                $extract->is_sent_extracted *= 3;
                            }
                            if($extract->is_sent_extracted > 1){
                                $extract->save();
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
                        if($extract->save()){
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
                    if($extract->save()){
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
            $voidChange = Lotteries::model()->findAll($voidCriteria);
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
                if($void->save()){
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
            $crit->addCondition('t.status = 1');
            $crit->addCondition('t.is_sent = 0');
            $crit->order = "id";
            $crit->limit = 5;
            $tickets = Tickets::model()->findAll($crit);
            foreach($tickets as $ticket){
                try {
                    $res=EmailManager::model()->sendTicket($ticket);
                    if($res){
                        $ticket->is_sent = 1;
                        if(!$ticket->save()){
                            Yii::log("Sending tickets error: ".$ticket->id,'error');
                            $errors['tickets'][]="Sending tickets error: ".$ticket->id;
                        }
                    } else {
                        Yii::log("Sending tickets error: ".$ticket->id,'error');
                        $errors['tickets'][]="Sending tickets error: ".$ticket->id;
                    }
                } catch (Exception $exc) {
                    Yii::log($exc->getTraceAsString(),'error');
                    $errors['tickets'][]="Sending tickets error: ".$ticket->id;
                }
            }
        }
        
        public function getMyFavoriteLotteries(){
            $userId = Yii::app()->user->id;
            $crit = new CDbCriteria();
            $crit->select = 't.lottery_id';
            $crit->addCondition('t.user_id = '.$userId);
            $crit->addCondition('t.active = 1');
            $favLots = FavoriteLottery::model()->findAll($crit);
//            $favArr = CHtml::listData( $favLots, 'id','lottery_id');
            $favArr = CHtml::listData( $favLots, 'lottery_id','lottery_id');
            return $favArr;
        }
        
        /*public function checkToExtract(&$errors){
            // check close to extracted
            $extractCriteria = new CDbCriteria();
            $extractCriteria->addCondition('t.status = '.Yii::app()->params['lotteryStatusConst']['closed']);
            $extractCriteria->addCondition('t.lottery_close_date <= '.new CDbExpression("NOW() - INTERVAL 1 HOUR"));
            $extractChange = Lotteries::model()->findAll($extractCriteria);
            foreach($extractChange as $extract){
                Yii::log("Extraction: lottery=".$extract->id, "warning");
                $winner=null;
                $winnerTicket=null;
                $criteria=new CDbCriteria; 
                $lotteryTickets = Yii::app()->db->createCommand()
                ->select('serial_number')
                ->from('tickets')
                ->where('lottery_id=:lotid and status=1', array(':lotid'=>$extract->id))
                ->queryColumn();
                if($lotteryTickets){
                    // extract winner
                    if(count($lotteryTickets) == 1){
                        $winner=$lotteryTickets[0];
                    } else {
                        $winner=Lotteries::model()->genRandomTicketSerial(); 
                    }
                    $checkWinner=true;
                    while ($checkWinner){ 
                        $existTicket = in_array($winner,$lotteryTickets);
                        if($existTicket){
                            $checkForOwner = (!empty($existTicket->user_id) && $existTicket->user->is_active);
                            if($checkForOwner){
                                //winner FOUND
                                $checkWinner=false;
                                $winnerTicket=$existTicket;
                            } else {
                                if(count($lotteryTickets) == 1){
                                    break;
                                }
                                $winner=Lotteries::model()->genRandomTicketSerial();
                            }
                        } else {
                            $winner=Lotteries::model()->genRandomTicketSerial();
                        }
                    }
                    if($winnerTicket){
                        $extract->status = Yii::app()->params['lotteryStatusConst']['extracted'];
                        $extract->lottery_extract_date = new CDbExpression('NOW()');
                        $extract->winner_id = $winnerTicket->user_id;
                        $extract->winner_ticket_id = $winnerTicket->id;
                        if($extract->save()){
                            Yii::log("Lottery extract: Id=".$extract->id.", name=".$extract->name, "warning");
                            //send email for opening
                            $emailRes=EmailManager::sendExtractLotteryToWinner($extract);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
                            }
                            $emailRes=EmailManager::sendExtractLotteryToOwner($extract);
                            if(!$emailRes){
                                Yii::log("Err sending email: ".$emailRes, "error");
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
                    }
                } else {
                    Yii::log("No tickets: lottery=".$extract->id, "warning");
                }
            }
        }*/
}
