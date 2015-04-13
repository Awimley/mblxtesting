 <?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$commodityID = $name = $desc = $uom = "";

include('../database_access.php');
try {
  //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblbargelines SET name = ?,desc = ?,uom = ? WHERE commodityID = ? ");
      $statement->bind_param('sssi', $name, $desc, $uom, $commodityID);
      $bargeLineID = test_input($dataPosted["commodityID"]);
      $name = test_input($dataPosted["name"]);
      $desc = test_input($dataPosted["desc"]);
      $uom = test_input($dataPosted["uom"]);
            
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