<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare(<<<SQL
  
SELECT
	contractCommodityID,
	contractID,
	commodityID,
	tonnage,
	net_or_metric
FROM
	mblxdev.trefcontract_commodities;
      
        
SQL
);
 
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $contractId, $commodityId, $tonnage, $netOrMetric);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "contract_id" => $contractId,
                "commodity_id" => $commodityId,
                "tonnage" => $tonnage,
                "net_or_metric" => $netOrMetric
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
