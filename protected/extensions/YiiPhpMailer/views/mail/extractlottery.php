<p>La tua lotteria è estratta!</p>

<p><?php echo $lottery->name; ?></p>

<p>Vincitore: <?php echo $winner->serial_number; ?></p>

<p>Vincitore UserID: <?php echo $winner->user_id; ?></p>

<div>
    <div>Verrai contattato dal vincitore (ti scriverà da questa mail):</div>
    <div>Vincitore: <b><?php echo $lottery->winner->username; ?></b> - Email: <?php echo $lottery->winner->email; ?></div>
    <div>Se hai segnalazioni o problemi scrivi a: <a href="mailto:help@wonlot.com">help@wonlot.com</a></div>
</div>