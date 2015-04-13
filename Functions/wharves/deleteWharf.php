<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);

$id = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
    UPDATE mblxdev.tblwharves SET 
    active = 0
    WHERE wharfID = ?;
SQL
);
    
    $statement->bind_param('i', $id);

    $id = test_input($dataPosted["wharf_id"]);
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