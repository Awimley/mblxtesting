<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $country = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblorigins (name, country) VALUES (?,?)");
    $statement->bind_param('ss', $name);
    
   
    $name  = test_input($dataPosted["name"]);
    $country  = test_input($dataPosted["country"]);
    
    
    $statement->execute();
    
    if ($statement->error) {
        $errorData = "Database query failed: " . $statement->error;
        die(json_encode($errorData));
    } else {
        $returnJson = array(
            "status" => "okay"
            
        );
        echo json_encode($returnJson);
    }
    
}

catch (PDOException $e) {
    echo $e->getMessage();
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
