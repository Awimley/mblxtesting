<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contactName = $address = $city = $state = $zip = $phone = $fax = $email = $notes = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblstevedores (name, contact_name, address, city, state, zip, phone, fax, email, notes) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $statement->bind_param('ss', $name);
    
   
    $name  = test_input($dataPosted["name"]);
    $contactName = test_input($dataPosted["contactName"]);
    $address = test_input($dataPosted["address"]);
    $city = test_input($dataPosted["city"]);
    $state = test_input($dataPosted["state"]);
    $zip = test_input($dataPosted["zip"]);
    $phone = test_input($dataPosted["phone"]);
    $fax = test_input($dataPosted["fax"]);
    $email = test_input($dataPosted["email"]);
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
