 <?php

  header('Content-Type: application/json');
  $dataPosted = json_decode(file_get_contents('php://input'), true);
  $bargeLineID = $name = $contact = $address = $city = $state = $zip = $phone = $fax = $notes = $activeStatus = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblbargelines SET name = ?,contact = ?,address = ?, city = ?, state = ?,zip = ?, phone = ?, fax = ?, notes = ?, active = ? WHERE bargeLineID = ? ");
      $statement->bind_param('sssssssssii', $name, $contact, $address, $city, $state, $zip, $phone, $fax, $notes, $activeStatus, $bargeLineID);
      
      $bargeLineID = test_input($dataPosted["bargeLineID"]);
      $name = test_input($dataPosted["bargeLineName"]);
      $contact = test_input($dataPosted["bargeLineContact"]);
      $address = test_input($dataPosted["bargeLineAddress"]);
      $city = test_input($dataPosted["bargeLineCity"]);
      $state = test_input($dataPosted["bargeLineState"]);
      $zipCode = test_input($dataPosted["bargeLineZip"]);
      $phoneNumber = test_input($dataPosted["bargeLinePhone"]);
      $fax = test_input($dataPosted["bargeLineFax"]);
      $notes = test_input($dataPosted["bargeLineNotes"]);
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


   function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
