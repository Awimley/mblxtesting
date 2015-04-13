<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare(<<<SQL
select distinct barge_type from trefbarges;
SQL
);
        $statement->execute();
        
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($bargeTypeName);
       
        
        while ($statement->fetch()) {
           array_push($data, $bargeTypeName);
            
           
          
        }
        $returnData['data'] = $data;
        echo json_encode($returnData, JSON_PRETTY_PRINT);
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   
    
?>
