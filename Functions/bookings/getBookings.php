<?php
header('Content-Type: application/json');
include('../database_access.php');
try {
    
    $data = array();
    $returnData = array();
    $statement = $databaseConnection->prepare("SELECT bookingId, customerId, booking_date, final_date, booking_number, transportation_type, brokerId, destinationId, terminalId, booking_company, serviceId, customer_contractId, carrier_contractId, customer_reference, status, notes, active FROM mblxdev.tblbookings;"); 
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $customerId, $bookingDate, $finalDate, $bookingNumber, $transportation, $brokerId, $destinationId, $terminalId, $bookingCompany, $serviceId, $customer_contractId, $carrier_contractId, $customerReference, $status, $notes, $active);
    $counter = 0;
    while ($statement->fetch()) {
        
        $data[$counter] = array(
            "id" => $id,
            "customer_id" => $customerId,
            "booking_date" => $bookingDate,
            "final_date" => $finalDate,
            "booking_number" => $bookingNumber,
            "transportation_type" => $transportation,
            "broker_id" => $brokerId,
            "destination_id" => $destinationId,
            "terminal_id" => $terminalId,
            "booking_company" => $bookingCompany,
            "service_id" => $serviceId,
            "customer_contract_id" => $customer_contractId,
            "carrier_contract_id" => $carrier_contractId,
            "customer_reference" => $customerReference,
            "status" => $status,
            "notes" => $notes,
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
