<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$serviceId=$name=$code=$active= "";
include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
UPDATE
    mblxdev.tblservices
SET
    service_name = ?,
    service_code = ?,
    active = ?
WHERE serviceID = ?;
SQL
);
    
    $statement->bind_param('ssii', $name,$code,$active,$serviceId);
    $name = test_input($dataPosted["name"]);
    $code  = test_input($dataPosted["code"]);
    $active  = test_input($dataPosted["active_status"]);
    $serviceId  = test_input($dataPosted["serviceId"]);
 
    
    
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