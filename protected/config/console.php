<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
include "db.php";
include "extParams.php";
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),
    
        'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.YiiPhpMailer.YiiMailer',
	),
    
        'params'=>array(
            // this is used in contact page
            'adminEmail'=>'webmaster@example.com',
            'isCron'=>true,
            'lotteryTypes'=>$lotteryTypes,
            'lotteryTypesConst'=>$lotteryTypesConst,
            'lotteryStatusConst'=>$lotteryStatusConst,
            'toDbDateTimeFormat'=>$toDbDateTimeFormat,
            'toUserDateFormat'=>$toUserDateFormat,
            'toUserTimeFormat'=>$toUserTimeFormat,
            'baseUrl'=>'http://test.wonlot.com/',
        ),

	// application components
	'components'=>array(
		'db'=> $db,
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
                                        'logFile'=>'wonlot-cron.log',
					'levels'=>'error, warning',
				),
			),
		),
	),
);
