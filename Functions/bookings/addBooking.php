<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblbookings (
    customerId
    ,booking_date
    ,final_date
    ,booking_number
    ,transportation_type
    ,brokerId
    ,destinationId
    ,terminalId
    ,booking_company
    ,serviceId
    ,customer_contractId
    ,carrier_contractId
    ,customer_reference
    ,status
    ,notes
    ,active
    ,vesselTripId
    )
VALUES (
    ?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,?
    ,1
    ,?
    );");
    $statement->bind_param('iddssiiisiiisssi', $customerId, $booking_date, $final_date, $booking_number, $transportation_type, $brokerId,
     $destinationId, $terminalId, $booking_company, $serviceId, $customer_contractId, $carrier_contractId, $customer_reference,
      $status, $notes, $vesselTripId);
    
    $customerId  = test_input($dataPosted["custId"]);
    $booking_date  = $dataPosted["bookingDate"] ;
    $final_date = $dataPosted["finalDate"] ;
    $booking_number    = test_input($dataPosted["bookingNumber"]);
    $transportation_type    = test_input($dataPosted["transportation"]);
    $brokerId    = test_input($dataPosted["brokerId"]);
    $destinationId    = test_input($dataPosted["destinationId"]);
    $terminalId    = test_input($dataPosted["terminalId"]);
    $booking_company    = test_input($dataPosted["booking_company"]);
    $serviceId    = test_input($dataPosted["serviceId"]);
    $customer_contractId    = test_input($dataPosted["customer_contractId"]);
    $carrier_contractId    = test_input($dataPosted["carrier_contractId"]);
    $customer_reference    = test_input($dataPosted["customer_reference"]);
    $status    = test_input($dataPosted["status"]);
    $vesselTripId    = test_input($dataPosted["vesselTripId"]);
   
    
    
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
