<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$custId = $contactName = $contactPhone = $contactEmail = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblcontacts (customer_id, name, phone, email) VALUES (?, ?, ?, ?)");
    $statement->bind_param('isss', $custId, $contactName, $contactPhone, $contactEmail);
    
    $custId  = test_input($dataPosted["id"]);
    $contactName  = test_input($dataPosted["name"]);
    $contactPhone = test_input($dataPosted["phone"]);
    $contactEmail    = test_input($dataPosted["email"]);
    
    
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
