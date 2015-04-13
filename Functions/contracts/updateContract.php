 <?php

  header('Content-Type: application/json');
  $dataPosted = json_decode(file_get_contents('php://input'), true);
  $contractNumber = $customerId = $start_date = $serviceId = $equipmentId = $end_date = $demurrage = $contract_type = $notes = $activeStatus = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblcontracts SET contractNumber = ?,customerId = ?,start_date = ?,serviceId = ?,equipmentId = ?,end_date = ?,demurrage = ?,contract_type = ?,notes = ?,activeStatus WHERE contractID = ?");
      $statement->bind_param('sisissssi', $contractNumber, $customerId, $start_date, $serviceId, $equipmentId, $end_date, $demurrage, $contract_type, $notes, $activeStatus);
      
      $contractNumber = test_input($dataPosted["contractNumber"]);
      $customerId = test_input($dataPosted["customerId"]);
      $start_date = test_input($dataPosted["start_date"]);
      $serviceId = test_input($dataPosted["serviceId"]);
      $equipmentId = test_input($dataPosted["equipmentId"]);
      $end_date = test_input($dataPosted["end_date"]);
      $demurrage = test_input($dataPosted["demurrage"]);
      $contract_type = test_input($dataPosted["contract_type"]);
      $notes = test_input($dataPosted["notes"]);
      $activeStatus = test_input($dataPosted["activeStatus"]);
       
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
