<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
//$code = $name = $phone = $fax = $address = $city = $state = $postCode = $country = $email = $activeStatus = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblvesseltrip (vesselID, vessel_trip_name, eta_date, unload_date, countryId, stevedoreID, wharfID, voyage_number, notes, barge_order_notes, active, agentID) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?);");
    $statement->bind_param('isddiiisssi', $vesselId, $vesselTripName, $etaDate, $unloadDate, $countryId, $stevedoreId, $wharfId, $voyageNumber, $notes, $bargeOrderNotes, $agentId);
    $vesselId  = test_input($dataPosted["vesselId"]);
    $vesselTripName  = test_input($dataPosted["name"]);
    $etaDate = $dataPosted["eta_date"];
    $unloadDate   = $dataPosted["unload_Date"];
    $countryId = test_input($dataPosted["country_of_origin_id"]);
    $stevedoreId  = test_input($dataPosted["stevedoreId"]);
    $wharfId     = test_input($dataPosted["wharfId"]);
    $voyageNumber   = test_input($dataPosted["voyage_number"]);
    $notes = test_input($dataPosted["notes"]);
    $bargeOrderNotes  = test_input($dataPosted["barge_order_notes"]);
    $agentId    = test_input($dataPosted["agentId"]);
    
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
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
