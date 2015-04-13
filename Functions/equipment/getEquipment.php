<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("select equipmentID, equipment_name, transportation_type, active_status from tblequipment");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name, $type, $active);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $name,
                "type" => $type,
                
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
