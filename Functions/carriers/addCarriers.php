<?php

header('Content-type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$name = $contact = $address = $city = $state = $zipCode = $phoneNumber = $fax = $notes = "";

include('../database_access.php');

try {

    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblcarriers (name) VALUES (?)");
    $statement->bind_param('s', $name);

    $name = test_input($dataPosted["name"]);
    

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