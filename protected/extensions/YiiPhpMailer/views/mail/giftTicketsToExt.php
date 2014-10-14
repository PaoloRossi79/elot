<p>Hai acquistato dei Ticket!</p>

<?php foreach($tickets as $ticket){
    $lot = $ticket['lottery'];
    $tic = $ticket['tickets'];
?>
    <p>Asta: <?php echo $lot->name; ?></p>
    <?php foreach($tic as $t){ ?>
        <p>Ticket: <?php echo $t->serial_number; ?></p>
        <p>Prezzo nominale: <?php echo $t->value; ?></p>
        <p>Prezzo pagato: <?php echo $t->price; ?></p>
    <?php } ?>
    <hr>
<?php } ?>