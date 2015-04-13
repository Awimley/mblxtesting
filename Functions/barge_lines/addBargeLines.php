<?php

header('Content-type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contact = $address = $city = $state = $zipCode = $phoneNumber = $fax = $notes = "";

include('../database_access.php');

try {

    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblbargelines(name, contact, address, city, state, zip, phone, fax, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param('sssssssss', $name, $contact, $address, $city, $state, $zipCode, $phoneNumber, $fax, $notes);
    
    
    $name = test_input($dataPosted["bargeLineName"]);
    $contact = test_input($dataPosted["bargeLineContact"]);
    $address = test_input($dataPosted["bargeLineAddress"]);
    $city = test_input($dataPosted["bargeLineCity"]);
    $state = test_input($dataPosted["bargeLineState"]);
    $zipCode = test_input($dataPosted["bargeLineZip"]);
    $phoneNumber = test_input($dataPosted["bargeLinePhone"]);
    $fax = test_input($dataPosted["bargeLineFax"]);
    $notes = test_input($dataPosted["bargeLineNotes"]);
    
    $statement->execute();

    if($statement->error){
      $errorData - "Database query failed: " . $statement->error;
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
function test_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
?>