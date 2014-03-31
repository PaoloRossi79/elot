<p>Errore in CRON !</p>

<?php
    foreach ($errors as $k=>$err){
        echo "<h3>".$k."</h3>";
        echo "<ul>";
        foreach ($err as $k => $e){
            echo "<li>".$e."</li>";
        }
        echo "</ul>";
    }
?>