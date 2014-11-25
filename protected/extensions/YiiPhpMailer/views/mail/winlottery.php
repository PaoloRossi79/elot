<h1>HAI VINTO!!!!</h1>

<h2>Congratulazioni <?php echo $lottery->winner->profile->first_name." ".$lottery->winner->profile->last_name; ?></h2>

<p>Hai vinto questa Asta: <?php echo $lottery->name; ?></p>


<div>
    <div>Per ricevere il premio mettiti in contatto con il venditore (scrivendogli da questa mail):</div>
    <?php if($lottery->owner && $lottery->owner->username && $lottery->owner->email){ ?>
        <div>Venditore: <b><?php echo $lottery->owner->username; ?></b> - Email: <?php echo $lottery->owner->email; ?></div>
    <?php } ?>
    <div>Se hai segnalazioni o problemi scrivi a: <a href="mailto:help@wonlot.com">help@wonlot.com</a></div>
</div>