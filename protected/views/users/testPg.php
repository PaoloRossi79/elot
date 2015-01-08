<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Payment Gateway Test Page</title>
</head>
<style>
fieldset{padding: 5px; border: 1px solid #999; 	margin: 0 10px 20px 10px; }
legend{font: bold 120%/1.6 Arial,sans-serif; padding: 0 5px; color: #666; }
fieldset label{
	float:left; 
	width:250px; 
	border-bottom: 1px solid #ddd;
	line-height: 25px; 
	margin: 0 5px 5px 0;
	padding-right: 3px;
	text-align: right;
	font-weight:bold;
}
fieldset br{ clear: left; }

</style>
<body>
	<h2>Convertitore MD5</h2>
	
	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
		<label for="md5">Valore da convertire:</label>
		<input type="text" name="md5" id="md5" value="" size="30" maxlength="20" />
		<br />
		MD5: <?php echo isset($_POST["md5"]) ? md5($_POST["md5"]) : "Nessun valore"; ?>
		<br />
		<input type="submit" id="submit" value="MAKE MD5" />
	</form>
	
	<h1>Simulazione del Response URL del Payment Gateway</h1>
	
	<form action="http://localhost/it/payment-gateway/response-url/" method="post">

		<fieldset>
			<legend>Dati da IMPOSTARE</legend>
				<label for="paymentid">paymentid:</label>
				<input type="text" name="paymentid" id="paymentid" value="" size="30" maxlength="20" />
				<br />
				
				<label for="result">result:</label>
				<select name="result" id="result">
				   <option value="APPROVED">APPROVED</option>
				   <option value="NOT APPROVED">NOT APPROVED</option>
				   <option value="CAPTURED" selected>CAPTURED</option>
				   <option value="NOT CAPTURED">NOT CAPTURED</option>
				   <option value="DENIED BY RISK">DENIED BY RISK</option>
				   <option value="HOST TIMEOUT">HOST TIMEOUT</option>
				</select>
				<br />
				
				<label for="trackid">trackid:</label>
				<input type="text" name="trackid" id="trackid" value="" size="40" maxlength="256" />
				<br />
				
		</fieldset>

		<fieldset>
			<legend>Dati secondari (modificabili a piacimento)</legend>
			
				<label for="tranid">tranid:</label>
				<input type="text" name="tranid" id="tranid" value="6328764111801310" size="30" maxlength="20" />
				<br />
				<label for="auth">auth:</label>
				<input type="text" name="auth" id="auth" value="999999" size="10" maxlength="9" />
				<br />
				<label for="postdate">postdate (formato mmgg):</label>
				<input type="text" name="postdate" id="postdate" value="<?php echo date("md"); ?>" size="10" maxlength="4" />
				<br />
				<label for="ref">ref:</label>
				<input type="text" name="ref" id="ref" value="ref00000000001" size="40" maxlength="60" />
				<br />
				
			<?php for($i=1; $i<=5; $i++) { ?>
				<label for="udf<?php echo $i; ?>">udf<?php echo $i; ?>:</label>
				<input type="text" name="udf<?php echo $i; ?>" id="udf<?php echo $i; ?>" value="" size="40" maxlength="256" />
				<br />
			<?php } ?>
			
				<label for="responsecode">responsecode:</label>
				<input type="text" name="responsecode" id="responsecode" value="00" size="4" maxlength="2" />
				<br />
				<label for="cardtype">cardtype:</label>
				<input type="text" name="cardtype" id="cardtype" value="VISA" size="12" maxlength="10" />
				<br />
				<label for="payinst">payinst:</label>
				<input type="text" name="payinst" id="payinst" value="VPAS" size="12" maxlength="10" />
				<br />
				<label for="liability">liability:</label>
				<input type="text" name="liability" id="liability" value="Y" size="2" maxlength="1" />
				<br />
				
		</fieldset>

			<input type="submit" id="submit" value="INVIA" />
		</form>
	
</body>
</html>
