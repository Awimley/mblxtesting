<?php

  header('Content-Type: application/json');
  $dataPosted = json_decode(file_get_contents('php://input'), true);

  $OriginID = $name = $country = $activeStatus = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblbargelines SET name = ?, country = ?,activeStatus = ? WHERE OriginID = ? ");
      $statement->bind_param('ssii', $name, $country, $activeStatus, $OriginID);
      $bargeLineID = test_input($dataPosted["OriginID"]);
      $name = test_input($dataPosted["name"]);
      $contact = test_input($dataPosted["country"]);
      $activeStatus = test_input($dataPosted["active_status"]);
       
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
}

   function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
