<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT serviceID, service_name from mblxdev.tblservices where active = 1 order by serviceID asc");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $name
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
