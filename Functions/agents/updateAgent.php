 <?php

  header('Content-Type: application/json');
  $dataPosted = json_decode(file_get_contents('php://input'), true);
  $agentID = $name = $contact_name = $address = $city = $state = $zip = $phone = $fax = $email = $notes = $activeStatus = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblbargelines SET name = ?,contact = ?,address = ?, city = ?, state = ?,zip = ?, phone = ?, fax = ?, email = ?, notes = ?, active = ? WHERE agentID = ? ");
      $statement->bind_param('sssssssssii', $name, $contact, $address, $city, $state, $zip, $phone, $fax, $email, $notes, $activeStatus, $agentID);
      $bargeLineID = test_input($dataPosted["agentID"]);
      $name = test_input($dataPosted["name"]);
      $contact = test_input($dataPosted["contact"]);
      $address = test_input($dataPosted["address"]);
      $city = test_input($dataPosted["city"]);      
      $state = test_input($dataPosted["state"]);
      $zip = test_input($dataPosted["zip"]);
      $phone = test_input($dataPosted["phone"]);
      $fax = test_input($dataPosted["fax"]);
      $notes = test_input($dataPosted["notes"]);
      $email = test_input($dataPosted["email"]);
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
