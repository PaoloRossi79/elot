<?php
/*********************************************************************************
 * Project:     Payment Gateway Class (Consorzio Triveneto S.p.A.)
 * File:        PgConsTriv.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @author Davide Gullo (gullo [at] m4ss [dot] net)
 * @package PgConsTriv Class
 * @version 1.3 (12/05/2010)
 *
 *********************************************************************************/

/*
   ------------------------------------------------------------------------------------
   | Online documentation for this class is available on:
   | http://www.m4ss.net/os-open-source/payment-gateway-consorzio-triveneto-php-class
   ------------------------------------------------------------------------------------
*/


	class PgConsTriv
	{
		// language
		private $lng; // ISO 639-1 Code
		private $hasLanguage = false;

		// Tipo di transazione (action)
		private $action;

		// array variabili da inviare per il PaymentInit
		private $arPayInit = array();
		// variabili RICEVUTE dal PaymentInit
		private $PayInit_ID;
		private $PayInit_URL;
		private $PayInit_ERROR = null;
		private $PayInit_Code = null;

		// variabili del NotificationMessage
		private $arNotMess = array();
		private $NotMess_ID;

		// Array delle Action gestite (PaymentInit e Payment)
		private $arAction = array(
								'Purchase' 		=> 1,
								'Credit' 		=> 2,
								'Reversal' 		=> 3,
								'Authorization'	=> 4,
								'Capture' 		=> 5,
								'Void' 			=> 9,
							);
							
		// Array per conversione Lingue da codifica del PG a ISO
		private $arLingue = array(
						'it' => 'ITA',
						'en' => 'USA',
						'es' => 'ESP',
						'de' => 'DEU',
						'fr' => 'FRA',
						);

	/*
	*  Constructor
	*/
		function __construct($l=null)
		{
			//include Configuration file
			//require_once _SRV_WEBROOT.'plugins/xt_triveneto/classes/PgConsTriv.inc.php';
                        require_once 'PgConsTriv.inc.php';
			// try to set Language
			if(!is_null($l))
			{
				if(isset($this->arLingue[$l])) {
					$this->lng = $l;
					$this->hasLanguage = true;
				} else {
					throw new Exception('LINGUA ('.$l.') non gestita dal Payment Gateway. Vedi documentazione.');
				}
			} else {
				// set ISO 639-1 Code for default language
				$this->lng = array_search(_PG_Default_LangId, $this->arLingue);
				$this->hasLanguage = false;
			}
		}

/*
 	Function:	set_Action
	Set Tipo di transazione (action) che sto effettuando
*/
		function setAction($a)
		{
			if(isset($this->arAction[$a]))
			{
				$this->action = $this->arAction[$a];
			} else {
				throw new Exception('Azione non gestita da questa classe. Vedi documentazione.');
			}
		}

/***********************************
* 	Metodi per il PaymentInit
* *********************************/
/*
 	Function:	setSecurityCode_PI
	Set Codice di sicurezza che verr� inviato via GET insieme al PaymentURL
*/
		function setSecurityCode_PI($sc)
		{
			$this->PayInit_Code = $sc;
		}
/*
 	Function:	setCampoUdf_PI
	Set Campi UDF (Campi a discrezione del Merchant)
*/
		function setCampoUdf_PI($n, $val)
		{
			$udf = 'udf'.$n;
			$this->setVal_PayInit($udf, $val );
		}

/*
 	Function:	sendVal_PI
	Invio Messaggio PaymentInit ed elaborazione della risposta
*/
		function sendVal_PI( $amt, $trackid)
		{
			// Set valori da inviare via POST
			$this->setVal_PayInit('id', $this->get_PG_ID_Merchant() );
			$this->setVal_PayInit('password', $this->get_PG_Password() );
			$this->setVal_PayInit('action', $this->action);
			$this->setVal_PayInit('amt', $amt);
			$this->setVal_PayInit('currencycode', _PG_CurrencyCode);
			$this->setVal_PayInit('langid', $this->getLngPG());
			$this->setVal_PayInit('responseURL', $this->getResponseURL_PaymentInit());
			$this->setVal_PayInit('errorURL', $this->getErrorURL_PaymentInit());
			$this->setVal_PayInit('trackid', $trackid);
			$this->setVal_PayInit('udf4', $this->PayInit_Code );

			// Send valori via POST
			$res = $this->SendPost($this->get_PG_URL_PaymentInit(), $this->arPayInit);
			$this->debug ("DEBUG PaymentInit result: ".$res);
			
			// Set valori restituiti dalla transazione inviata
			$this->setVal_ResponsePayInit($res);
		}

/*
 	Function:	hasError_PI
	Restituisce Bool per esistenza ERRORE sul PaymentInit
*/
		function hasError_PI()
		{
			return is_null($this->PayInit_ERROR) ? false : true;
		}
/*
 	Function:	getError_PI
	Restituisce Messaggio di ERRORE del PaymentInit
*/
		function getError_PI()
		{
			return is_null($this->PayInit_ERROR) ? "NESSUN ERRORE!" : $this->PayInit_ERROR;
		}
/*
 	Function:	getID_PI
	Restituisce PaymentID restituito dalla chiusura della transazione del PaymentInit
*/
		function getID_PI()
		{
			return $this->PayInit_ID;
		}
/*
 	Function:	getPaymentURL_PI
	Restituisce l'URL verso cui redirezionare l'utente (Cardholder) dopo la conclusione della transazione PaymentInit
*/
		function getPaymentURL_PI()
		{
			$url = $this->PayInit_URL . "?PaymentID=" . $this->getID_PI();
			return $url;
		}

/*********************************************
* 	Metodi per il NotificationMessage
* *******************************************/

/*
 	Function:	setVal_NM
	Set Variabili inviate dal NotificationMessage
*/
		function setVal_NM($post)
		{
			$this->arNotMess = $post;
		}

/*
 	Function:	isValid_NM
	Verifica validit� dei dati del NotificationMessage in base al SecurityCode
*/
		function isValid_NM()
		{
			if( is_null($this->PayInit_Code) ) {
				return false;
			} else {
				return ( $this->PayInit_Code == $this->getVal_NM('udf4') ) ? true : false;
			}
		}

/*
 	Function:	isTransError_NM
	Restituisce Bool true se si � verificato un ERRORE durante la TRANSAZIONE
*/
		function isTransError_NM()
		{
			return (isset($this->arNotMess["Error"]) && isset($this->arNotMess["ErrorText"])) ? true : false;
		}
/*
 	Function:	isTransGood_NM
	Restituisce Bool true se la TRANSAZIONE � stata elaborata
*/
		function isTransGood_NM()
		{
			return (isset($this->arNotMess["result"]) && isset($this->arNotMess["trackid"])) ? true : false;
		}
/*
	Verifica Stati (result) della Transazione
*/
		function isCaptured_NM() { return ($this->getVal_NM("result") == "CAPTURED") ? true : false; }
		function isNotCaptured_NM() { return ($this->getVal_NM("result") == "NOT CAPTURED") ? true : false; }
		function isApproved_NM() { return ($this->getVal_NM("result") == "APPROVED") ? true : false; }
		function isNotApproved_NM() { return ($this->getVal_NM("result") == "NOT APPROVED") ? true : false; }
		function isDeniedByRisk_NM() { return ($this->getVal_NM("result") == "DENIED BY RISK") ? true : false; }
		function isHostTimeout_NM() { return ($this->getVal_NM("result") == "HOST TIMEOUT") ? true : false; }

/*
 	Function:	getVal_NM
	Restituisce un valore ($v) se presente nell'array settato con setVal_NM($post)
	* In caso non esista restituisce un valore null
*/
		function getVal_NM($v)
		{
			return isset($this->arNotMess[$v]) ? $this->arNotMess[$v] : null;
		}

/*
 	Function:	getPaymentID_NM
	Get PaymentID
	* In caso non sia settato restituisce false
*/
		function getPaymentID_NM()
		{
			return is_null($this->getVal_NM("paymentid")) ? false : $this->getVal_NM("paymentid");
		}

/*
 	Function:	getURL_NM
	Restituisce l'URL verso cui redirezionare l'utente (Cardholder)
	* L'URL viene creato in base a:
	* - risposta fornita dal server: valore result settato tramite il metodo setVal_NM($post)
	* - action impostata con set_Action($a)
*/
		function getURL_NM()
		{
			// inizio a costruire l'indirizzo
			$url = "http://" . _PG_URL_base;
			switch($this->action)
			{
				case 1:
					$url .= $this->isCaptured_NM() ? _PG_goodURL : _PG_errorURL;
				break;
				case 4:
					$url .= $this->isApproved_NM() ? _PG_goodURL : _PG_errorURL;
				break;
			}
			$urlLng = $this->makeURLwithLng($url);
			return $urlLng;
		}

/***********************************
* 	Utility & Miscellanueos
* *********************************/

/*
	Function:	setVal_ResponsePayInit
	Converte l'array e lo invia tramite POST all'url specificato
*/
		private function setVal_ResponsePayInit($r)
		{
			// Verifico esito del PaymentInit
			if(strpos($r, "ERROR") === false )
			{
				// Scompongo la stringa e recupero PaymentID e PaymentURL
				$dd = strpos($r, ":");
				$PayID = substr($r, 0, $dd);
				$PayURL = substr($r, ($dd+1));
				// Set PaymentID e PaymentURL
				$this->PayInit_ID = $PayID;
				$this->PayInit_URL = $PayURL;
			} else {
				$this->PayInit_ERROR = $r;
			}
		}

/*
 	Function:	setVal_PayInit
	Converte l'array e lo invia tramite POST all'url specificato
*/
		private function setVal_PayInit($k, $v)
		{
			if(!is_null($v)) {
				$this->arPayInit[$k] = $v;
			}
		}

/*
 	Function:	reset_PayInit
	Reset dell'array PayInit
*/
		private function reset_PayInit()
		{
			$this->arPayInit = array();
		}

/*
 	Function:	SendPost
	Invia valori tramite POST all'url specificato
*/
		private function SendPost($url, $arVal)
		{
			$handle = curl_init();
			curl_setopt($handle, CURLOPT_URL, $url);
			curl_setopt($handle, CURLOPT_VERBOSE, true);
			curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//			curl_setopt($handle, CURLOPT_CAINFO, _PATH_ROOT_SISTEMA . "\include\curl-ca-bundle.crt");
			curl_setopt($handle, CURLOPT_POST, true);
			curl_setopt($handle, CURLOPT_POSTFIELDS, $this->get_UrlEncodedFromArray($arVal));
                        Yii::log("SendPost","warning");
                        Yii::log("URL POST=".$this->get_UrlEncodedFromArray($arVal),"warning");
			$buffer = curl_exec($handle);

			if($buffer === false)
			{
			    echo 'Curl error: ' . curl_error($handle);
			}

			curl_close($handle);
			return $buffer;
		}

/*
 	Function:	get_UrlEncodedFromArray
	Converte l'array in stringa da inviare poi via POST
*/
		private function get_UrlEncodedFromArray($ar)
		{
			$str = "";
			if(count($ar) > 0) {
				foreach($ar AS $k => $v) {
					$str .= $k."=".urlencode($v)."&";
				}
				$str = substr($str, 0, -1);
			}
			return $str;
		}

/*
 	Function:	getResponseURL_PaymentInit
	Restituisce l'URL verso cui redirezionare l'utente (Cardholder)
*/
		private function getResponseURL_PaymentInit()
		{
			return $this->makeURLwithLng("http://" . _PG_URL_base . _PG_responseURL);
		}

/*
 	Function:	getErrorURL_PaymentInit
	Restituisce l'URL verso cui redirezionare l'utente (Cardholder)
*/
		private function getErrorURL_PaymentInit()
		{
			return $this->makeURLwithLng("http://" . _PG_URL_base . _PG_errorURL);
		}

/*
 	Function:	makeURLwithLng
	Imposta la lingua nell'URL passato a seconda delle propriet� $lng e $hasLanguage
*/
		private function makeURLwithLng($url)
		{
			$urlLng = ($this->hasLanguage) ? sprintf( $url, $this->lng ) : $url;
			return $urlLng;
		}

/*
 	Function:	get_PG_URL_PaymentInit
	Restituisce l'URL da utilizzare per il PaymentInit in base a Test o Produzione
*/
		private function get_PG_URL_PaymentInit()
		{
			$url = constant("_PG_URL_PaymentInit_" . _PG_System_Environment);
			return $url;
		}
/*
 	Function:	get_PG_ID_Merchant
	Restituisce ID_Merchant da utilizzare per il PaymentInit in base a Test o Produzione
*/
		private function get_PG_ID_Merchant()
		{
			$url = constant("_PG_ID_Merchant_" . _PG_System_Environment);
			return $url;
		}
/*
 	Function:	get_PG_Password
	Restituisce Password da utilizzare per il PaymentInit in base a Test o Produzione
*/
		private function get_PG_Password()
		{
			$url = constant("_PG_Password_" . _PG_System_Environment);
			return $url;
		}
		
/*
 	Function:	getLngPG
	Restituisce la lingua secondo la codifica del Payment Gateway
*/
		private function getLngPG()
		{
			return $this->arLingue[$this->lng];
		}
		
	
		function debug ($s) {
			return; // no debugging
			$txt = $_SERVER['REMOTE_ADDR'];
			$f = fopen (_SRV_WEBROOT.'plugins/xt_triveneto/classes/pgconstriv.txt', "a+");
			$date = date('c');
			$dbg = print_r ($s, true);
			@fprintf ($f, "$date (" . ($txt ? "$txt" : '') . ") - ");
			fprintf ($f, $dbg . "\n");
			fclose ($f);
		} // debug()

	}
?> 