<?php
    ini_set('wincache.fcenabled','0');
    

    $databaseConnection2 = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($databaseConnection2->connect_error) {
        die("Database selection failed: " . $databaseConnection2->connect_error);
    }

?>

