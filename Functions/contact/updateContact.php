<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$contId = $contactName = $contactPhone = $contactEmail = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("UPDATE mblxdev.tblcontacts SET name=?, phone=?, email=? WHERE contact_id=?");
    $statement->bind_param('sssi', $contactName, $contactPhone, $contactEmail, $contId);
    
    $contId  = test_input($dataPosted["id"]);
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
