<?php

//BUNCH OF STUFF -- new asdfasdf
header('Content-Type: application/json');
include('../database_access.php');
try {
    
    $data = array();
    $returnData = array();
    $statement = "";
    $typeSelect = $_GET["type"];
    if ($typeSelect == "CON" ){
        $statement = $databaseConnection->prepare("select con.contractID, con.customer_id, cust.name, con.contract_number, con.origin_id, ori.name, con.destination_id, dest.destination_name, con.serviceID, svc.service_name, con.barge_minimum, con.active_status, con.rate, con.demurrage, con.free_days, con.notes, con.contract_type, con.start_date, con.end_date, con.NUM_OF_BARGES, equ.equipment_name, con.equipment_id from tblcontracts_old con inner join tblcustomers cust on con.customer_id = cust.customer_id inner join tblorigins ori on con.origin_id = ori.originID inner join tbldestinations dest on con.destination_id = dest.destinationID inner join tblservices svc on con.serviceId = svc.serviceId inner join tblequipment equ on con.equipment_id = equ.equipmentID where con.contract_type = 'CON' order by con.end_date DESC");
        
    } else {
        $statement = $databaseConnection->prepare("select con.contractID, con.customer_id, cust.name, con.contract_number, con.origin_id, ori.name, con.destination_id, dest.destination_name, con.serviceID, svc.service_name, con.barge_minimum, con.active_status, con.rate, con.demurrage, con.free_days, con.notes, con.contract_type, con.start_date, con.end_date, con.NUM_OF_BARGES, equ.equipment_name, con.equipment_id from tblcontracts_old con inner join tblcustomers cust on con.customer_id = cust.customer_id inner join tblorigins ori on con.origin_id = ori.originID inner join tbldestinations dest on con.destination_id = dest.destinationID inner join tblservices svc on con.serviceId = svc.serviceId inner join tblequipment equ on con.equipment_id = equ.equipmentID where con.contract_type = 'CUST' order by con.end_date DESC");
        
    }
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $custId, $custName, $number, $oriId, $oriName, $destId, $destName, $serviceId, $serviceName, $bargeMin, $active, $rate, $demurrage, $free_days, $notes, $type, $start, $end, $numBarges, $equipmentName, $equipmentId);
    $counter = 0;
    while ($statement->fetch()) {
        
        $data[$counter] = array(
            "id" => $id,
            "customer_id" => $custId,
            "customer_name" => $custName,
            "destination_name" => $destName,
            "contract_number" => $number,
            "origin_id" => $oriId,
            "origin_name" => $oriName,
            "destination_id" => $destId,
            "destination_name" => $destName,
            "service_id" => $serviceId,
            "service_name" => $serviceName,
            "barge_minimum" => $bargeMin,
            "active" => $active,
            "rate" => $rate,
            "demurrage" => $demurrage,
            "free_days" => $free_days,
            "notes" => $notes,
            "type" => $type,
            "start_date" => $start,
            "end_date" => $end,
            "number_barges" => $numBarges,
            "equipment_name" => $equipmentName,
            "equipment_id" => $equipmentId
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
