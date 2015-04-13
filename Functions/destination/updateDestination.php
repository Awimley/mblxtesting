 <!--
 NOT FUNCTIONAL
-->
 <?php

include('../database_access.php');

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$destId = $name = $activeStatus = "";
include('../database_access.php');

try {
  $statement = $databaseConnection->prepare("UPDATE mblxdev.tbldestinations SET name = ?, active_status = ? WHERE destinationID = ? ");
  $statement->bind_param('sii', $name, $active_status, $destinationID);

  $destinationID = test_input($dataPosted["destinationID"]);
  $name = test_input($dataPosted["name"]);
  $active_status = test_input($dataPosted["active_status"]);

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

   function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?> 