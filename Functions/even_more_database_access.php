<?php
    ini_set('wincache.fcenabled','0');
    

    $databaseConnection3 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($databaseConnection3->connect_error) {
        die("Database selection failed: " . $databaseConnection3->connect_error);
    }

?>

