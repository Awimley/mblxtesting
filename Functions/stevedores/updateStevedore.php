<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contactname = $address = $city = $state = $zip = $phone = $fax = $email = $notes = $active = $id = "";
include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
UPDATE
    mblxdev.tblstevedores
SET
    name = ?,
    contact_name = ?,
    address = ?,
    city = ?,
    state = ?,
    zip = ?,
    phone = ?,
    fax = ?,
    email = ?,
    notes = ?,
    active = ?
WHERE stevedoreID = ?;
SQL
);
    
    $statement->bind_param('ssssssssssii', $name, $contactname, $address, $city, $state, $zip, $phone, $fax, $email, $notes, $active, $id);
    $contactname = test_input($dataPosted["contact_name"]);
    $name  = test_input($dataPosted["name"]);
    $city  = test_input($dataPosted["city"]);
    $state  = test_input($dataPosted["state"]);
    $address  = test_input($dataPosted["address"]);
    $email = test_input($dataPosted["email"]);
    $id = test_input($dataPosted["stevedoreId"]);
    $zip_code = test_input($dataPosted["zip_code"]);
    $phone = test_input($dataPosted["phone"]);
    $fax = test_input($dataPosted["fax"]);
    $active = test_input($dataPosted["active_status"]);
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