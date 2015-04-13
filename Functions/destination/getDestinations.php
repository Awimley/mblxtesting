<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("select d.destinationID, CONCAT(c.name, ', ',c.state) as destination_name, d.active from tbldestinations d inner join trefcities c on d.cityID = c.cityID");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $destName, $active);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $destName,
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
