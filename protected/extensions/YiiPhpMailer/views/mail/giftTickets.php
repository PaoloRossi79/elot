<p>Ti sono stati regalati dei Ticket!</p>

<?php foreach($tickets as $ticket){
    $lot = $ticket['lottery'];
    $tic = $ticket['tickets'];
?>
    <p>Lotteria: <?php echo $lot->name; ?></p>
    <?php foreach($tic as $t){ ?>
        <p>Ticket: <?php echo $t->serial_number; ?></p>
        <p>Prezzo nominale: <?php echo $t->value; ?></p>
        <p>Regalato da: <?php echo $t->giftFromUser->username; ?></p>
    <?php } ?>
    <hr>
<?php } ?>