<?php

header('Content-type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $milePoint = $river = $contactName = $address = $city = $zipCode = $phoneNumber = $fax = $notes = $email = "";

include('../database_access.php');

try {

    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblterminals (name, mile_point, riverCode, contact_name, address, cityID, zip, phone, fax, notes, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param('sssssssssss', $name, $milePoint, $river, $contactName, $address, $city, $zipCode, $phoneNumber, $fax, $notes, $email);

    $name = test_input($dataPosted["name"]);
    $milePoint = test_input($dataPosted["milePoint"]);
    $river = test_input($dataPosted["river"]);
    $contactName = test_input($dataPosted["contactName"]);
    $address = test_input($dataPosted["address"]);
    $city = test_input($dataPosted["city"]);
    $zipCode = test_input($dataPosted["zipCode"]);
    $phoneNumber = test_input($dataPosted["phoneNumber"]);
    $fax = test_input($dataPosted["fax"]);
    $notes = test_input($dataPosted["notes"]);
    $email = test_input($dataPosted["email"]);

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