<p>Errore in chiusura Lotteria!</p>

<p><?php echo $model->id. " - ".$model->name; ?></p>

<?php
    foreach ($model->getErrors() as $err){
        foreach ($err as $k => $e){
            echo $k.") ".$e;
        }
    }
?>