<?php
ini_set('wincache.fcenabled','0');
header('Content-Type: application/json');

define('DB_NAME', 'mblxdev');
define('DB_USER', 'root');
define('DB_PASSWORD', 'jup5iter!');
define('DB_HOST', '69.28.90.21');

define('DEFAULT_ADMIN_USERNAME', 'root');
define('DEFAULT_ADMIN_PASSWORD', 'jup5iter!');
$databaseConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($databaseConnection->connect_error) {
    die("Database selection failed: " . $databaseConnection->connect_error);
}
try {
    
    $data = array();
    
    $statement = $databaseConnection->prepare("SELECT customer_id, name FROM mblxdev.tblcustomers");
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $custName);
    $counter = 0;
    while ($statement->fetch()) {
        
        $data[$counter] = array(
            "id" => $id,
            "name" => $custName,
            "rank" => rand(1, 100)
        );
        $counter++;
        
        
    }
    echo json_encode($data);
}

catch (PDOException $e) {
    echo $e->getMessage();
}

?>
