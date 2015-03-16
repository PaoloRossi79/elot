<?php
/*
$db = array(
        'connectionString' => 'mysql:host=localhost;dbname=elot',
        'emulatePrepare' => true,
        'username' => 'root',
        'password' => 'localdb',
        'username' => 'elot',
        'password' => 'elotroot',
        'charset' => 'utf8',
);*/

$db = array(
        'connectionString' => 'mysql:host=db4free.net;dbname=elot',
        'emulatePrepare' => true,
        'username' => 'elot',
        'password' => 'rootelot',
        'charset' => 'utf8',
);

$fbconfig = array(
    'class' => 'ext.yii-facebook-opengraph.SFacebook',
    'appId'=>'552702101478191', // needed for JS SDK, Social Plugins and PHP SDK
    'secret'=>'83c3f51fa2bc74d89b057599f773b764', // needed for the PHP SDK
    /*'appId'=>'231401853702434', // needed for JS SDK, Social Plugins and PHP SDK --> DEV on 24.eu
    'secret'=>'3d4bf721f54303038ea2717ec728ab98', // needed for the PHP SDK --> DEV on 24.eu */ 
    //'fileUpload'=>false, // needed to support API POST requests which send files
    //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
    //'locale'=>'en_US', // override locale setting (defaults to en_US)
    //'jsSdk'=>true, // don't include JS SDK
    //'async'=>true, // load JS SDK asynchronously
    //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
    //'status'=>true, // JS SDK - check login status
    //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
    //'oauth'=>true,  // JS SDK - enable OAuth 2.0
    //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
    //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
    //'html5'=>true,  // use html5 Social Plugins instead of XFBML
    //'ogTags'=>array(  // set default OG tags
        //'title'=>'MY_WEBSITE_NAME',
        //'description'=>'MY_WEBSITE_DESCRIPTION',
        //'image'=>'URL_TO_WEBSITE_LOGO',
    //),
  );

?>
