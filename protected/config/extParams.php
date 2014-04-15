<?php

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

$specialOffers = array(
    0 =>
    array(
        'name'=>'Discount on ticket buy',
        'desc'=>'Discount on ticket buy'
    ),
    1 =>
    array(
        'name'=>'Discount on wMoney buy',
        'desc'=>'Discount on wMoney buy'
    ),
);

$speditionType = array(
    array('id'=> 0, 'type' => 'Delivered by a courier'),
    array('id'=> 1, 'type' => 'Winner colllects'),
    array('id'=> 2, 'type' => 'To be defined with winner'),
);

$speditionTypeId = array(
    0 => 'Delivered by a courier',
    1 => 'Winner colllects',
    2 => 'To be defined with winner',
);

$lotteryStatusConst = array(
    'draft'=>1,
    'upcoming'=>2,
    'open'=>3,
    'closed'=>4,
    'extracted'=>5,
    'void'=>6,
);
$lotterySearchStatusConst = array(
    'In corso'=>1,
    'In arrivo'=>2,
    'Estratte'=>3,
);
$userTransactionConst = array(
    'buyTicket'=>1,
    'buyCredit'=>2,
    'refundTicket'=>3,
    'refundCredit'=>4,
    'withdraw'=>5,
);
$userTransactionId = array(
    1=>'Acquisto Ticket',
    2=>'Acquisto Credito',
    3=>'Rimborso Ticket',
    4=>'Rimborso Credito',
    5=>'Ritiro fondi',
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
);

$buyCreditOptions = array(
    0=>'15',
    1=>'25',
    2=>'50',
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
