<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
include "db.php";
include "extParams.php";
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'WonLot',

	// preloading 'log' component
	'preload'=>array(
            'log',
            'bootstrap'
        ),
    
        //	'language'=>'it',
	'timeZone' => 'Europe/Rome',

	'sourceLanguage'=>'en',
	'language'=>'en',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendors.*',
		'application.extensions.*',
		'application.extensions.EGMap.*',
                'application.extensions.galleria.*',
                'ext.YiiPhpMailer.YiiMailer',
                'zii.widgets.jui.CJuiWidget',
                'zii.widgets.jui.CJuiInputWidget',
                'zii.widgets.jui.zii.widget.grid.CGridColumn',
	),
    
        'aliases' => array(
            //If you manually installed it
            'xupload' => 'ext.xupload',
//            'booster' => 'ext.yiibooster2',
            'gmap' => 'ext.EGMap',
        ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'qwerty',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'userTypes'=>array(
                            'user'=>1,
                            'admin'=>2,
                            'company'=>3,
                        ),
		),
                /*'request' => array(
                    'baseUrl' => $localBaseUrl,
                ),*/
                'mailer' => array(
                    'class' => 'application.extensions.mailer.EMailer',
                    'pathViews' => 'application.views.emailTemplate',
                    'pathLayouts' => 'application.views.emailLayouts'
                 ),
            
                /*'bootstrap' => array(
                    'class' => 'booster.components.Bootstrap',
                    'responsiveCss' => true,
                ),*/
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=> $db,
		/*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=my_paolorossi79',
			'emulatePrepare' => true,
			'username' => 'paolorossi79',
			'password' => 'rsspla79',
			'charset' => 'utf8',
		),*/

		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
                                        'logFile'=>'wonlot.log',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CFileLogRoute',
                                        'logFile'=>'wonlot-trace.log',
					'levels'=>'trace',
				),
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute',
                                        'levels'=>'error, warning, info',
				),*/
				
			),
		),
            //'facebook' => $fbconfig,
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
            // this is used in contact page
            'adminEmail'=>'paolorossi79@gmail.com',
            'hashString'=>'e9a5561e42c5ab47c6c81c14f06c0b8281cfc3ce',
            'lotteryTypes'=>$lotteryTypes,
            'lotteryTypesConst'=>$lotteryTypesConst,
            'lotteryStatusConst'=>$lotteryStatusConst,
            'lotterySearchStatusConst'=>$lotterySearchStatusConst,
            'userTransactionConst'=>$userTransactionConst,
            'userTransactionId'=>$userTransactionId,
            'notifyTypeConst'=>$notifyTypeConst,
            'notifyTypeMsg'=>$notifyTypeMsg,
            'ticketStatusConst'=>$ticketStatusConst,
            'buyCreditOptions' => $buyCreditOptions,
            'authExtSource' => $authExtSource,
            'image_versions' => $image_versions,
            'speditionType' => $speditionType,
            'speditionTypeId' => $speditionTypeId,
            'specialOffersType' => $specialOffers,
            'companyTypes' => $companyTypesId,
            'prizeConditions' => $prizeConditions,
            'prizeConditionsId' => $prizeConditionsId,
            'payStatusConst'=>$payStatusConst,
	),
);
