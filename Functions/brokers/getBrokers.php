<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT brokerID, name, contact_name, address, city, state, zip, phone, fax, active FROM mblxdev.tblbrokers");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name, $contact, $address, $city, $state, $zip, $phone, $fax, $active);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $name,
                "contact" => $contact,
                "address" => $address,
                "city" => $city,
                "state" => $state,
                "zip" => $zip,
                "phone" => $phone,
                "fax" => $fax,
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
