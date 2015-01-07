<?php
/*********************************************************************************
 * Project:     Payment Gateway Class (Consorzio Triveneto S.p.A.)
 * File:        PgConsTriv.inc.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @author Davide Gullo (gullo [at] m4ss [dot] net)
 * @package PgConsTriv Class
 * @version 0.3
 *

	Riferimenti:
	* Consorzio Triveneto S.p.A.
	* Payment Gateway
	* Specifiche di Interfacciamento Merchant
	* Release 1.4.4

**********************************************************************************/

/************************************
* 	VALORI DA CONFIGURARE
************************************/

/* Test o Produzione
* 	Valori accettati:
* 		Test = Ambiente di Test
* 		Production = Ambiente in Produzione
*/
	define("_PG_System_Environment", "Test");

/* Dati Merchant */
	define("_PG_ID_Merchant_Test", "89025555"); 	// TEST
	define("_PG_Password_Test", "test");			// TEST
	define("_PG_ID_Merchant_Production", "");	// PRODUCTION
	define("_PG_Password_Production", "");	// PRODUCTION

/* Lingua e Valuta */
	define("_PG_CurrencyCode", "978");			// Valuta (978 = EURO)
	/*
	* Lingue disponibili per l'interfaccia del Payment Gateway:
	* 		USA = Inglese
	* 		FRA = Francese
	* 		DEU = Tedesco
	* 		ESP = Spagnolo
	* 		SLO = Sloveno
	*/
	define("_PG_Default_LangId", "ITA");		// Lingua Default (Italiano = ITA)

/* URL di Risposta */
	define("_PG_URL_base", "www.wonlot.com");
        //define("_PG_URL_base", "wonlotloc.it");
	/*
	* E' possibile aggiungere %s
	*	%s verr� valorizzato se viene passata una lingua in fase di inizializzazione della classe (Vedi __construct)
	*	Se non si desidera utilizzare alcuna lingua eliminare %s dagli URL qui sotto
	*/
	define("_PG_responseURL", "/users/confirmBuyCredit");
	define("_PG_errorURL", "/users/koBuyCredit");
	define("_PG_goodURL", "/users/okBuyCredit");

/************************************
	VALORI DA NON MODIFICARE
	* Validi per Release 1.4.4
************************************/

/* URL Payment Gateway e Variabili protocollo di comunicazione */
	define("_PG_URL_PaymentInit_Test", "https://test4.constriv.com/cg301/servlet/PaymentInitHTTPServlet");
	define("_PG_URL_PaymentInit_Production", "https://www.constriv.com/cg/servlet/PaymentInitHTTPServlet");
	define("_PG_URL_Payment_Test", "https://test4.constriv.com/cg301/servlet/PaymentTranHTTPServlet");
	define("_PG_URL_Payment_Production", "https://www.constriv.com/cg/servlet/PaymentTranHTTPServlet");


?> 