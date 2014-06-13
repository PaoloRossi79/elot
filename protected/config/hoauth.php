<?php
	#AUTOGENERATED BY HYBRIDAUTH 2.1.1-dev INSTALLER - Monday 18th of November 2013 09:32:21 PM

/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
return 
	array(
		"base_url" => Yii::app()->getBaseUrl(true)."/index.php/site/oauth", 
		"action_url" => array(
                    'oauth' => Yii::app()->getBaseUrl(true)."/index.php/site/oauth", 
                    'oauthshare' => Yii::app()->getBaseUrl(true)."/index.php/site/oauthshare", 
                ),
            
		"providers" => array ( 
			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"AOL"  => array ( 
				"enabled" => false 
			),

			"Yahoo" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "281789908562.apps.googleusercontent.com", "secret" => "1ItCVeo8OWmxN0W0ThAeg0G4" )
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "552702101478191", "secret" => "83c3f51fa2bc74d89b057599f773b764" )
			),

			"Twitter" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			// windows live
			"Live" => array ( 
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),

			"MySpace" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"LinkedIn" => array ( 
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" ) 
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ) 
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => "hoauth-log.txt"
	);
