<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$destinationid = $riverCode = $cityid = $notes = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tbldestinations (destinationID, riverCode, cityID, notes) VALUES (?, ?, ?, ?)");
    $statement->bind_param('ssss', $name);
    
   
    $destinationid  = test_input($dataPosted["destinationid"]);
    $riverCode  = test_input($dataPosted["riverCode"]);
    $cityid  = test_input($dataPosted["cityid"]);
    $notes  = test_input($dataPosted["notes"]);
    
    
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
