<?php
header('Content-Type: application/json');
include('../database_access.php');
try {
    
    $data = array();
    $returnData = array();
    $statement = $databaseConnection->prepare("SELECT wharfID, name, city, state, mile_point, active FROM mblxdev.tblwharves where active=1;");
    $statement->execute();
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    $statement->bind_result($id, $name, $city, $state, $milePoint, $active);
    $counter = 0;
    while ($statement->fetch()) {
        
        $data[$counter] = array(
            "id" => $id,
            "name" => $name,
            
            "city" => $city,
            "state" => $state,
            "mile_point" => $milePoint,
            
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
