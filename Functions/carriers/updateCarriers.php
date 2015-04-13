 <?php

  header('Content-Type: application/json');
  $dataPosted = json_decode(file_get_contents('php://input'), true);
  $carrierID = $name = $activeStatus = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblbargelines SET name = ?, active = ? WHERE carrierID = ? ");
      $statement->bind_param('sii', $name, $activeStatus, $carrierID);
      $bargeLineID = test_input($dataPosted["carrierID"]);
      $name = test_input($dataPosted["name"]);
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