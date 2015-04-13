<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);

$name = $city = $state = $milePoint = $notes = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblwharves(name, city, state, mile_point, active, notes) VALUES (?, ?, ?, ?, 1, ?)");
    $statement->bind_param('sssds', $name, $city, $state, $milePoint, $notes);
    
    $name  = test_input($dataPosted["name"]);
    $city  = test_input($dataPosted["city"]);
    $state  = test_input($dataPosted["state"]);
    $milePoint  = test_input($dataPosted["mile_point"]);
    $notes = test_input($dataPosted["notes"]);
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