<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $vesselID = $eta_date = "";

    
      $vesselID = test_input($dataPosted["vesselID"]);
       $eta_date = test_input($dataPosted["eta_date"]);
     
     
   

   include('database_access.php');
    try {
        $query_insert_vesselTrip = "INSERT INTO mblxdev.tblvesseltrip (vesselID, eta_date) VALUES ('$vesselID', '$eta_date')";
       $statement = $databaseConnection->prepare($query_insert_vesselTrip);
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
