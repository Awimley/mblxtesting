<?php

header('Content-type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contact = $address = $city = $state = $zipCode = $phoneNumber = $fax = $email = $notes = "";

include('../database_access.php');

try {

    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblagents (name, contact_name, address, city, state, zip, phone, fax, email, notes) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $statement->bind_param('ssssssssss', $name, $contact, $address, $city, $state, $zipCode, $phoneNumber, $fax, $email, $notes);

    $name = test_input($dataPosted["name"]);
    $contact = test_input($dataPosted["contact"]);
    $address = test_input($dataPosted["address"]);
    $city = test_input($dataPosted["city"]);
    $state = test_input($dataPosted["state"]);
    $zipCode = test_input($dataPosted["zipCode"]);
    $phoneNumber = test_input($dataPosted["phoneNumber"]);
    $fax = test_input($dataPosted["fax"]);
    $email = test_input($dataPosted["email"]);
    $notes = test_input($dataPosted["notes"]);
    

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