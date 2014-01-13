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

$speditionType = array(
    array('id'=> 0, 'type' => 'Delivered by a courier'),
    array('id'=> 1, 'type' => 'Winner colllects'),
    array('id'=> 2, 'type' => 'To be defined with winner'),
);

$lotteryStatusConst = array(
    'draft'=>1,
    'upcoming'=>2,
    'open'=>3,
    'active'=>4,
    'closed'=>5,
    'extracted'=>6,
);
$lotterySearchStatusConst = array(
    'Open only'=>1,
    'Upcoming'=>2,
    'Closed'=>3,
);
$userTransactionConst = array(
    'buyTicket'=>1,
    'buyCredit'=>2,
    'refundTicket'=>3,
    'refundCredit'=>4,
    'withdraw'=>5,
);
$ticketStatusConst = array(
    'open'=>1,
    'active'=>2,
    'closed'=>3,
    'refunded'=>4,
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
        'max_width' => 700,
        'max_height' => 2000,
        'crop_img' => true,
        'jpeg_quality' => 100,
    ),
    'gallerySmallThumb' => array(
        'max_width' => 200,
        'max_height' => 150,
        'crop_img' => true,
        'jpeg_quality' => 100,
    ),
);

?>
