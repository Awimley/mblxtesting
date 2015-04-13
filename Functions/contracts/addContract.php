<?php

header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);
//echo json_encode($dataPosted, JSON_PRETTY_PRINT);

//$customerId = $contractNumber = $equipmentId = $originId = $destinationId = $serviceId = $bargeMinimum = $rate = $demurrage = $freeDays = $notes = "";


//var_dump($rateData);


$last_id = '';

include('../database_access.php');
try {

    //$query_insert_customer = ;
    $typeOfThing = $dataPosted["type"];

    if ($typeOfThing == "CUST") {
        $statement = $databaseConnection->prepare(<<<SQL
INSERT INTO mblxdev.tblcontracts (customer_id, contract_number, start_date, end_date, demurrage, notes, contract_type, serviceID, equipmentID) VALUES ( ?, ?, ?, ?, ?, ?, 'CUST', ? , ?)
SQL
        );
        $statement->bind_param('isssdsii', $customerId, $contractNumber, $startDate, $endDate, $demurrage, $notes, $serviceId, $equipmentId);

        $customerId = test_input($dataPosted["customerId"]);
        $contractNumber = test_input($dataPosted["contractNumber"]);
        $startDate = test_input($dataPosted["start_date"]);
        $endDate = test_input($dataPosted["end_date"]);
        $equipmentId = test_input($dataPosted["EquipmentId"]);

        $services  = $dataPosted["services"];
        $demurrage = test_input($dataPosted["demurrage"]);



        $notes = test_input($dataPosted["notes"]);


        $statement->execute();
        $last_id = $databaseConnection->insert_id;
        insertServices($last_id, $services);

        $rateData = $dataPosted['rateData'];

        foreach ($rateData as $rateD) {
            $state = $databaseConnection->prepare(<<<SQL
INSERT INTO mblxdev.trefContractRates (contractId, originId, destinationId, rateValueAQ, rateValue300, rateValue500, rateValue800, rateValue1000, rateValue1200, rateValue1400, rateValue1600, rateValueFlat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
SQL
            );
            $contId = $originId = $destinationId = $rateValueAQ = $rateValue300 = $rateValue500 = $rateValue800 = $rateValue1000 = $rateValue1200 = $rateValue1400 = $rateValue1600 = $rateValueFlat = 0;
            $state->bind_param('iiiddddddddd', $contId, $originId, $destinationId, $rateValueAQ, $rateValue300, $rateValue500, $rateValue800, $rateValue1000, $rateValue1200, $rateValue1400, $rateValue1600, $rateValueFlat);
            $contId = $last_id;
            $originId = $rateD['originId'];
            $destinationId = $rateD['destinationId'];
            $rateValueAQ = $rateD['AQ'];
            $rateValue300 = $rateD['300'];
            $rateValue500 = $rateD['500'];
            $rateValue800 = $rateD['800'];
            $rateValue1000 = $rateD['1000'];
            $rateValue1200 = $rateD['1200'];
            $rateValue1400 = $rateD['1400'];
            $rateValue1600 = $rateD['1600'];
            $rateValueFlat = $rateD['Flat Charge'];
            $state->execute();

        }
        
        $commData = $dataPosted['commodities'];
        
        foreach ($commData as $comm) {
        $stateM =  $databaseConnection->prepare(<<<SQL
INSERT INTO mblxdev.trefcontract_commodities
	(contractID, commodityID, tonnage, net_or_metric) VALUES 
	(? , ?, ?, ?);
SQL
            );
        $contrId = $commId = $comTonnage = 0;
        $stateM->bind_param('iiis', $contrId, $commId, $comTonnage, $netOrMetric);
        $contrId = $last_id;
        $commId = $comm['id'];
        $comTonnage = $comm['tonnage'];
        $netOrMetric = $comm['netOrMetric'];
        $stateM->execute();
        
        }
    } else {
        /* $statement = $databaseConnection->prepare("INSERT INTO mblxdev.tblContracts (customer_id, contract_number, equipment_id, origin_id, destination_id, serviceID, barge_minimum, active_status, rate, demurrage, contract_type, start_date, end_date, free_days, notes, num_of_barges) VALUES ( ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, 'CON', ?, ?, ?, ?, ?)");
         $statement->bind_param('isiiiisddssdsi', $customerId, $contractNumber, $equipmentId, $originId, $destinationId, $serviceId, $bargeMinimum, $rate, $demurrage, $startDate, $endDate, $freeDays, $notes, $barges);

         $customerId  = test_input($dataPosted["customerId"]);
         $contractNumber  = test_input($dataPosted["contractNumber"]);
         $equipmentId = test_input($dataPosted["EquipmentId"]);
         $originId   = test_input($dataPosted["OriginId"]);
         $destinationId   = test_input($dataPosted["DestinationId"]);
         $serviceId  = test_input($dataPosted["ServiceId"]);
         $bargeMinimum     = test_input($dataPosted["bargeMinimum"]);
         $rate    = test_input($dataPosted["rate"]);
         $demurrage = test_input($dataPosted["demurrage"]);
         $startDate  = test_input($dataPosted["start_date"]);
         $endDate  = test_input($dataPosted["end_date"]);
         $freeDays  = test_input($dataPosted["free_days"]);

         $notes    = test_input($dataPosted["notes"]);
         $barges    = test_input($dataPosted["number_barges"]);

         $statement->execute();*/
    }


    if ($statement->error) {
        $errorData = "Database query failed: " . $statement->error;
        die(json_encode($errorData));
    } else {
        $returnJson = array(
            "status" => "okay"
        );
        echo json_encode($returnJson);
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function insertServices($contractId, $serviceArra) {
    foreach ($serviceArra as $servId) {
        
        try {
            include('../more_database_access.php');
             $statement2 = $databaseConnection2->prepare(<<<SQL
    INSERT INTO mblxdev.trefcontractservices
	(contractId, serviceId, notes, active)
VALUES 
	(?, ?, 'test', 1);
SQL
        );
            $statement2->bind_param('ii', $contractIdP, $serviceIdP);
            $contractIdP = $contractId;
            $serviceIdP = $servId;
             $statement2->execute();
            if ($statement2->error) {
                $errorData = "Database query failed: " . $statement2->error;
                die(json_encode($errorData));
            } else {
                $databaseConnection2->close();
                
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    
}

?>
