<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT commodityID, name, description, uom FROM mblxdev.tblcommodities");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $commName, $commDesc, $commUom);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $commName,
                "desc" => $commDesc,
                "uom" => $commUom
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
