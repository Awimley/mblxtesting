<?php

header('Content-Type: application/json');

include('../database_access.php');
try {
    
    $data = array();
    
    $statement = $databaseConnection->prepare("SELECT vesselTripID, vesselID, vessel_trip_name, eta_date, unload_date, countryId, stevedoreID, wharfID, voyage_number, notes, barge_order_notes, agentID, active FROM mblxdev.tblvesseltrip "); 
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($vesselTripId, $vesselID, $vesselTripName, $etaDate, $unloadDate, $countryId, $stevedoreId, $wharfId, $voyageNumber, $notes, $bargeOrderNotes, $agentId, $active);
    $counter = 0;
    while ($statement->fetch()) {
        
        $data[$counter] = array(
             "id" => $vesselTripId,
             "vessel_id" => $vesselID,
             "name" => $vesselTripName,
             "eta_date" => $etaDate,
             "unload_date" => $unloadDate,
             "country_of_origin_id" => $countryId,
             "stevedore_id" => $stevedoreId,
             "wharf_id" => $wharfId,
             "voyage_number" => $voyageNumber,
             "notes" => $notes,
             "barge_order_notes" => $bargeOrderNotes,
             "agent_id" => $agentId,
             "active" => $active
             
        );
        $counter++;
        
        
    }
    $returnData['data'] = $data;
    echo json_encode($returnData, JSON_PRETTY_PRINT);
}

catch (PDOException $e) {
    echo $e->getMessage();
}

?>
