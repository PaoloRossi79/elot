<?php

$toDbDateTimeFormat = 'dd/MM/yyyy HH:mm:ss';
$toUserDateFormat = 'dd/mm/yy';
$toUserTimeFormat = 'hh:mm:ss';

$lotteryTypes = array(
    array(
        'id'=>1,
        'name'=>'Fixed Time Lottery',
        'desc'=>'Lottery with a pre-fixed draw date. Buying tickets is allowed till 30 minutes before the draw.'
    ),
    array(
        'id'=>2,
        'name'=>'Limited Ticket Lottery',
        'desc'=>'Lottery with a limited number of tickets. Draw date is variable: it happens 1 hour after last ticket sold.'
    ),
);
$companyTypes = array(
    0 => array(
        'name'=>'Produttore',
        'desc'=>'Produttore',
    ),
    1 => array(
        'name'=>'Ingrosso',
        'desc'=>'Distributore all\'ingrosso',
    ),
    2 => array(
        'name'=>'Dettaglio',
        'desc'=>'Distributore al dettaglio'
    ),
);

$companyTypesId = array(0=>"Produttore",1=>"Ingrosso",2=>"Dettaglio");

$prizeConditions = array(
    array(
        'id'=>1,
        'name'=>'Nuovo',
        'desc'=>'Lottery with a pre-fixed draw date. Buying tickets is allowed till 30 minutes before the draw.'
    ),
    array(
        'id'=>2,
        'name'=>'Usato',
        'desc'=>'Lottery with a limited number of tickets. Draw date is variable: it happens 1 hour after last ticket sold.'
    ),
);

$prizeConditionsId = array(
    1 => 'Nuovo',
    2 => 'Usato',
);

$specialOffersType = array(
    0 =>
    array(
        'name'=>Yii::t('wonlot','Sconto su acquisto Ticket'),
        'desc'=>Yii::t('wonlot','Sconto su acquisto Ticket')
    ),
    1 =>
    array(
        'name'=>Yii::t('wonlot','Sconto su acquisto credito'),
        'desc'=>Yii::t('wonlot','Sconto su acquisto credito')
    ),
);

$specialOffersCode = array(
    'ticket-buy' => 0,
    'credit-buy' => 1,
);

$speditionType = array(
    array('id'=> 0, 'type' => Yii::t('wonlot','Consegnato via corriere')),
    array('id'=> 1, 'type' => Yii::t('wonlot','Ritiro a carico del vincitore')),
    array('id'=> 2, 'type' => Yii::t('wonlot','Da definire col vincitore')),
);

$speditionTypeId = array(
    0 => Yii::t('wonlot','Consegnato via corriere'),
    1 => Yii::t('wonlot','Ritiro a carico del vincitore'),
    2 => Yii::t('wonlot','Da definire col vincitore'),
);

$lotteryStatusConst = array(
    'draft'=>1,
    'upcoming'=>2,
    'open'=>3,
    'closed'=>4,
    'extracted'=>5,
    'void'=>6,
);
$lotteryStatusConstIta = array(
    'draft'=>'Draft',
    'upcoming'=>'In arrivo',
    'open'=>'Aperta',
    'closed'=>'Chiusa',
    'extracted'=>'Vinta',
    'void'=>'Annullata',
);
$lotterySearchStatusConst = array(
    'In corso'=>1,
    'In arrivo'=>2,
    'Estratte'=>3,
);
$payStatusConst = array(
    1 => Yii::t('wonlot','Richiesto'),
    2 => Yii::t('wonlot','Eseguito'),
);
$creditConstant = array(
    'maxMonthlyGiftCredit' => 250,
);
$userTransactionConst = array(
    'buyTicket'=>1,
    'buyCredit'=>2,
    'refundTicket'=>3,
    'refundCredit'=>4,
    'withdraw'=>5,
    'giftCreditFrom'=>6,
    'giftCreditTo'=>7,
);
$userTransactionId = array(
    1=>'Acquisto Ticket',
    2=>'Acquisto Credito',
    3=>'Rimborso Ticket',
    4=>'Rimborso Credito',
    5=>'Ritiro fondi',
    6=>'Credito ricevuto',
    7=>'Credito regalato',
);
$notifyTypeConst = array(
    'giftTicket'=>1,
    'giftCredit'=>2,
    'startFollow'=>3,
    'stopFollow'=>4,
    'winLottery'=>5,
    'extractLottery'=>6,
    'refoundTicket'=>7,
    'widthdrawSent'=>8,
    'widthdrawComplete'=>9,
);
$notifyTypeMsg = array(
    1=>array('fw'=>Yii::t('wonlot','ti ha regalato un Ticket:'),'bw'=>Yii::t('wonlot','hai regalato un Ticket:')), // gift ticket receive
    2=>array('fw'=>Yii::t('wonlot','ti ha regalato dei WlMoney:'),'bw'=>Yii::t('wonlot','hai regalato dei WlMoney:')), // gift money receive
    3=>array('fw'=>Yii::t('wonlot','ha iniziato a seguirti.'),'bw'=>Yii::t('wonlot','hai iniziato a seguire:')), // start follow receive
    4=>array('fw'=>Yii::t('wonlot','ha smesso di seguirti.'),'bw'=>Yii::t('wonlot','hai smesso di seguire:')), // stop follow receive
    5=>array('fw'=>Yii::t('wonlot','Hai vinto una Asta:'),'bw'=>''), // lottery won receive
    6=>array('fw'=>Yii::t('wonlot','Una tua Asta è stata estratta:'),'bw'=>''), // lottery extracted receive
    7=>array('fw'=>Yii::t('wonlot','Ti sono stati rimborsati dei Ticket:'),'bw'=>Yii::t('wonlot','hai rimborsato dei Ticket:')), // ticket refound receive
    8=>array('fw'=>Yii::t('wonlot','La tua richiesta di ritiro denaro è stata inviata: '),'bw'=>Yii::t('wonlot','')), // withdraw request sent
    9=>array('fw'=>Yii::t('wonlot','La tua richiesta di ritiro denaro è stata eseguita: '),'bw'=>Yii::t('wonlot','')), // withdraw request complete
);
$ticketStatusConst = array(
    'open'=>1,
    'active'=>2,
    'closed'=>3,
    'extracted'=>4,
    'refunded'=>5,
);

$lotteryTypesConst = array(
    'fixTime'=>1,
    'limTicket'=>2,
);

$authExtSource = array(
    'site'=>0,
    'Facebook'=>1,
    'Twitter'=>2,
    'Yahoo'=>3,
    'Google'=>4,
    'Live'=>5,
    'Email'=>6,
);

$buyCreditOptions = array(
    0=>'15',
    1=>'25',
    2=>'50',
    3=>'100',
    4=>'250',
    5=>'500',
);

$image_versions = array(
    // Uncomment the following version to restrict the size of
    // uploaded images:
    'smallThumb' => array(
        'max_width' => 50,
        'max_height' => 100,
    ),
    'mediumThumb' => array(
        'max_width' => 100,
        'max_height' => 200,
    ),
    'smallSquaredThumb' => array(
        'max_width' => 100,
        'max_height' => 100,
        'crop_img' => true,
        'jpeg_quality' => 60,
    ),
    'mediumSquaredThumb' => array(
        'max_width' => 200,
        'max_height' => 200,
        'crop_img' => true,
        'jpeg_quality' => 100,
    ),
    'largeThumb' => array(
        'max_width' => 300,
        'max_height' => 600,
    ),
    'boxThumb' => array(
        'max_width' => 200,
    ),
    'galleryBigThumb' => array(
        'max_width' => 600,
        'max_height' => 600,
        'crop_img' => true,
        'jpeg_quality' => 100,
    ),
    'gallerySmallThumb' => array(
        'max_width' => 400,
        'max_height' => 400,
        'crop_img' => true,
        'jpeg_quality' => 100,
    ),
);

?>
