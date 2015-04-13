<?php
    
    header('Content-Type: application/json');

    include('database_access.php');
    try {
    
        $data = array();
        
        $statement = $databaseConnection->prepare("SELECT vt.vesseltrip_id, v.vessel_name, vt.eta_date FROM mblxdev.tblvesseltrip vt inner join mblxdev.tblvessels v on vt.vesselID = v.vesselID");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($tripId, $vesselName, $tripEta);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $tripId,
                "vessel_name" => $vesselName,
                 "trip_eta" => $tripEta
            );
            $counter++;
           
          
        }
        echo json_encode($data);
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   
?>
