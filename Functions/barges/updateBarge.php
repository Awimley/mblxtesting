<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$id = $bargelineId = $bargeNumber = $type = $coverType = $active = "";
include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
UPDATE
    mblxdev.trefbarges
SET
    bargeLineID = ?,
    barge_number = ?,
    barge_type = ?,
    cover_type = ?,
    active = ?
WHERE bargeID = ?;
SQL
);
    
    $statement->bind_param('ssii', $bargelineId, $bargeNumber, $type, $coverType, $active, $id);
    
    $id = test_input($dataPosted["bargeId"]);
    $barlineId  = test_input($dataPosted["barge_line_id"]);
    $bargeNumber = test_input($dataPosted["barge_number"]);
    $type = test_input($dataPosted["barge_type"]);
    $coverType  = test_input($dataPosted["cover_type"]);
    $active = test_input($dataPosted["active_status"]); 
    
    
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