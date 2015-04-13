<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$id = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("update mblxdev.tblagents set active = '0' WHERE agentID = ?");
    $statement->bind_param('i', $id);
    
    $id  = test_input($dataPosted["id"]);
   
    
    
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
