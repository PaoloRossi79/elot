<h1>HAI VINTO!!!!</h1>

<h2>Congratulazioni <?php echo $winner->user->profile->first_name." ".$winner->user->profile->last_name; ?></h2>

<p>Hai vinto questa lotteria: <?php echo $lottery->name; ?></p>

<p>Biglietto Vincitore: <?php echo $winner->serial_number; ?></p>

<p>Vincitore UserID: <?php echo $winner->user_id; ?></p>

<p>Richiedi il premio: <?php echo CController::createUrl("tickets/view",array('id'=>$winner->id));?></p>