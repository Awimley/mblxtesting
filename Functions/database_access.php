<?php
    ini_set('wincache.fcenabled','0');
    

    define('DB_NAME', 'mblxdev');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'jup5iter!');
    define('DB_HOST', '69.28.90.21');
    
    /*define('DB_NAME', 'mblxdev');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '22whodat\$\%');
    define('DB_HOST', '69.28.90.21');*/

    define('DEFAULT_ADMIN_USERNAME', 'root');
    define('DEFAULT_ADMIN_PASSWORD', 'jup5iter!');
    $databaseConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($databaseConnection->connect_error) {
        die("Database selection failed: " . $databaseConnection->connect_error);
    }

?>

