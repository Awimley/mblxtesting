<?php


header('Content-Type: application/json');
include('../database_access.php');
include('../more_database_access.php');
include('../even_more_database_access.php');
try {
    
    $data       = array();
    $returnData = array();
    $statement  = "";
    // $typeSelect = $_GET["type"];
    // if ($typeSelect == "CON" ){
    $statement  = $databaseConnection->prepare(<<<SQL
SELECT con.contractID
	,con.customer_id
	,cust.NAME
	,con.contract_number
	,con.start_date
	,con.end_date
	,con.equipmentID
	,equ.equipment_name
	,con.demurrage
	,con.notes
FROM tblcontracts con
INNER JOIN tblcustomers cust ON con.customer_id = cust.customer_id
INNER JOIN tblequipment equ ON con.equipmentID = equ.equipmentID
WHERE con.contract_type = 'CUST'
ORDER BY con.end_date DESC
SQL
        );
    /*} else {
    die("can't yet");
    }*/
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $custId, $custName, $contractNumber, $startDate, $endDate, $equipmentId, $equipmentName, $demurrage, $notes);
    $counter = 0;
    while ($statement->fetch()) {
        
        $rateData    = array();
        
        $state       = $databaseConnection2->prepare(<<<SQL
        
SELECT
	contractRateId,
	contractId,
	originId,
	destinationId,
	rateValueAQ,
	rateValue300,
	rateValue500,
	rateValue800,
	rateValue1000,
	rateValue1200,
	rateValue1400,
	rateValue1600,
	rateValueFlat,
	notes
FROM mblxdev.trefContractRates
WHERE contractId = $id
SQL
        );
        $rateCounter = 0;
        
        $state->execute();
        if ($state->error) {
            die("Database query failed: " . $state->error);
        }
        $state->bind_result($rateId, $conId, $originId, $destinationId, $rateValueAQ, $rateValue300, $rateValue500, $rateValue800, $rateValue1000, $rateValue1200, $rateValue1400, $rateValue1600, $rateValueFlat, $notez);
        while ($state->fetch()) {
            $rateData[$rateCounter] = array(
                "rateId" => $rateId,
                "contract_id" => $conId,
                "origin_id" => $originId,
                "destination_id" => $destinationId,
                "rate_value_AQ" => $rateValueAQ,
                "rate_value_300" => $rateValue300,
                "rate_value_500" => $rateValue500,
                "rate_value_800" => $rateValue800,
                "rate_value_1000" => $rateValue1000,
                "rate_value_1200" => $rateValue1200,
                "rate_value_1400" => $rateValue1400,
                "rate_value_1600" => $rateValue1600,
                "rate_value_FLAT" => $rateValueFlat,
                "notes" => $notez

                

                
                
            );
            
            $rateCounter++;
        }
        $serviceData = array();
        
        $svcState = $databaseConnection3->prepare(<<<SQL
        SELECT
	contractServiceID,
	serviceId,
	notes
FROM
	mblxdev.trefcontractservices
WHERE
    contractId = $id and active = 1
    
SQL
);
        $svcState->execute();
        if($svcState->error) {
            die("Database query failed: " . $svcState->error);
        }
        $svcState->bind_result($contractServiceId, $serviceId, $notes);
        $serviceCounter = 0;
        while($svcState->fetch()) {
            $serviceData[$serviceCounter] = array (
                "contract_service_id" => $contractServiceId,
                "service_id" => $serviceId,
                "notes" => $notes
                );
            $serviceCounter++;
        
        }
        $data[$counter] = array(
            "id" => $id,
            "customer_id" => $custId,
            "customer_name" => $custName,
            "contract_number" => $contractNumber,
            "start_date" => $startDate,
            "end_date" => $endDate,
            "services" => $serviceData,
            //"service_name" => $serviceName,
            "equipment_id" => $equipmentId,
            "equipment_name" => $equipmentName,
            "demurrage" => $demurrage,
            "rates" => $rateData,
            "notes" => $notes
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