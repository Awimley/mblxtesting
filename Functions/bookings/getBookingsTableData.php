<?php
header('Content-Type: application/json');
include('../database_access.php');
try {
    
    $data = array();
    $returnData = array();
    $statement = $databaseConnection->prepare("SELECT
    bookingId,
    booking_status,
    booking_company,
    booking_number,
    customer_name,
    agent_name,
    vessel_name,
    date(eta_date) as eta_date,
    wharf_name,
    stevedore_name,
    destination_name,
    terminal_name,
    service_name
FROM
    mblxdev.get_booking_table_formatted_working;"); 
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $status, $booking_company, $booking_number, $customer_name,
     $agent_name, $vessel_name, $eta_date,
      $wharf_name, $stevedore_name, $destination_name, 
      $terminal_name, $service_name);
    $counter = 0;
    while ($statement->fetch()) {
        
        
        
        
        
        
        
        $data[$counter] = array(
            "id" => $id,
            "booking_company" => $booking_company,
            "booking_status" => $status,
            "booking_number" => $booking_number,
           "customer_name" => $customer_name,
           "commodities" => getCommoditiesForBooking($id),
            "agent_name" => $agent_name,
            "vessel_name" => $vessel_name,
            "eta_date" => $eta_date,
            "wharf_name" => $wharf_name,
            "stevedore_name" => $stevedore_name,
            "destination_name" => $destination_name,
            "terminal_name" => $terminal_name,
            "service_name" => $service_name
        );
        $counter++;
        
        
    }
    $returnData['data'] = $data;
    echo json_encode($returnData, JSON_PRETTY_PRINT);
}

catch (PDOException $e) {
    echo $e->getMessage();
}
function getCommoditiesForBooking($bookingId) {
    include('../more_database_access.php');
    $comArra = array();
    $comCount = 0;
    $statementString = "SELECT trf.trefbooking_commoditiesId, trf.commodityId, c.name, trf.piece_count, trf.tonnage, trf.bill_lading FROM mblxdev.trefbooking_commodities trf inner join tblcommodities c on trf.commodityId = c.commodityId where trf.bookingId = " . $bookingId;
    
    //echo $statementString;
    $stmt = $databaseConnection2->prepare($statementString); 
    
   
    $stmt->execute();
    
    if ($stmt->error) {
        die("Database query failed: " . $stmt->error);
    }
    $stmt->bind_result($trfId, $commodityId, $commodityName, $pieceCount, $tonnage, $billLading);
     while ($stmt->fetch()) {
         $comArra[$comCount] = array (
             "id" => $trfId,
             "commodity_id" => $commodityId,
             "commodity_name" => $commodityName,
             "piece_count" => $pieceCount,
             "tonnage" => $tonnage,
             "bill_lading" => $billLading
             );
         $comCount++;
     }
   /* if ($stmt->execute($bookingId)) {
         while ($row = $stmt->fetch()) {
            $comArra[$comCount] = $row;
            $comCount++;
        }
    } else {
    echo "SHIT AINT WORK";
    }*/
   
   
    return $comArra;
    /*$statement->bind_param('i', $bookingId);
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($, $booking_company, $booking_number, $customer_name,
     $agent_name, $vessel_name, $eta_date,
      $wharf_name, $stevedore_name, $destination_name, 
      $terminal_name, $service_name);
    $counter = 0;*/
    
    
}
?>
