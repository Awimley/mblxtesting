<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $vesseltripid = $vesselid = $voyageNumber = $name = $eta = $unload = $countryId = $agent = $stevedore = $wharfid = $notes = $activeStatus = "";


     
   

    include('../database_access.php');
    try {
       
       //$query_insert_customer = ;
       $statement = $databaseConnection->prepare("UPDATE mblxdev.tblvesseltrip SET vesselID = ?,vessel_trip_name = ?,eta_date = ?,unload_date = ?,  countryId = ?, stevedoreID = ?,wharfID = ?, voyage_number = ?, notes = ?, active = ?, agentID = ? WHERE vesselTripID= ? ");
       $statement->bind_param('isssiiissiii', $vesselId, $name, $eta, $unload, $countryId, $stevedore, $wharf, $voyageNumber, $notes, $activeStatus, $agent, $vesseltripid);
              $vesselId = test_input($dataPosted["vesselId"]);
       $voyageNumber = test_input($dataPosted["voyage_number"]);
      $name = test_input($dataPosted["name"]);
      $eta = test_input($dataPosted["eta_date"]);
      $unload = test_input($dataPosted["unload_date"]);
      
      $countryId = test_input($dataPosted["country_of_origin_id"]);
      $agent = test_input($dataPosted["agentId"]);
    
      $stevedore = test_input($dataPosted["stevedoreId"]);
      $wharf = test_input($dataPosted["wharfId"]);
      $notes = test_input($dataPosted["notes"]);
      $activeStatus = test_input($dataPosted["active_status"]);
      $vesseltripid = test_input($dataPosted["vesselTripID"]);
       
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
