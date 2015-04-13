<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contact_name = $address = $city = $state = $zip = $phone = $fax = $email = $notes = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
    INSERT INTO mblxdev.tblagents
	(name, contact_name, address, city, state, zip, phone, fax, email, notes)
VALUES 
	(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
SQL
);
    $statement->bind_param('ssssssssss', $name, $contact_name, $address, $city, $state, $zip, $phone, $fax, $email, $notes);
    
    $name  = test_input($dataPosted["name"]);
    $contact_name = test_input($dataPosted["contact_name"]);
    $address   = test_input($dataPosted["address"]);
    
    $city     = test_input($dataPosted["city"]);
    $state    = test_input($dataPosted["state"]);
    $zip = test_input($dataPosted["zip"]);
    $phone  = test_input($dataPosted["phone"]);
    $fax    = test_input($dataPosted["fax"]);
    $email    = test_input($dataPosted["email"]);
    $notes    = test_input($dataPosted["notes"]);
    
    
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
