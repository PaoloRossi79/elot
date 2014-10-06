<p>Errore in chiusura Asta!</p>

<p><?php echo $model->id. " - ".$model->name; ?></p>

<?php
    foreach ($model->getErrors() as $err){
        foreach ($err as $k => $e){
            echo $k.") ".$e;
        }
    }
?>