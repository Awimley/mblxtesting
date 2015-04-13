<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
$customerid = $bookingdate = $finaldate = $bookingnumber = $transportationtype = $brokerid = $destinationid = $terminalid = $bookingCompany = $serviceId = $customercontractid = $carriercontractid = $customerRef = $status = $notes = $active = $vesselTripId = $id = "";
include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare(<<<SQL
UPDATE
    mblxdev.tblbookings
SET
    customerId = ?,
    booking_date = ?,
    final_date = ?,
    booking_number = ?,
    transportation_type = ?,
    brokerId = ?,
    destinationId = ?,
    terminalId = ?,
    booking_company = ?,
    serviceId = ?,
    customer_contractId = ?,
    carrier_contractId = ?,
    customer_reference = ?,
    status = ?,
    notes = ?,
    active = ?,
    vesselTripId = ?
WHERE bookingId = ?;
SQL
);
    
    $statement->bind_param('sssssiiisiiisssiii', $customerid, $bookingdate, $finaldate, $bookingnumber, $transportationtype, $brokerid, $destinationid, $terminalid, $bookingCompany, $serviceId, $customercontractid, $carriercontractid, $customerRef, $status, $notes, $active, $vesselTripId, $id);
    
    $customerid = test_input($dataPosted["custId"]);
    $bookingdate  = test_input($dataPosted["bookingDate"]);
    $finaldate  = test_input($dataPosted["finalDate"]);
    $bookingnumber  = test_input($dataPosted["bookingNumber"]);
    $transportationtype  = test_input($dataPosted["transportation"]);
    $brokerid = test_input($dataPosted["brokerId"]);
    $destinationid = test_input($dataPosted["destinationId"]);
    $terminalid = test_input($dataPosted["terminalId"]);
    $bookingCompany = test_input($dataPosted["booking_company"]);
    $serviceId = test_input($dataPosted["serviceId"]);
    $customercontractid = test_input($dataPosted["customer_contractId"]);
    $carriercontractid = test_input($dataPosted["carrier_contractId"]);
    $customerRef  = test_input($dataPosted["customerReference"]);
    $status  = test_input($dataPosted["status"]);
    $notes  = test_input($dataPosted["notes"]);
    $active  = test_input($dataPosted["active_status"]);
    $vesselTripId = test_input($dataPosted["vesselTripId"]);
    $id = test_input($dataPosted["bookingId"]);

    
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