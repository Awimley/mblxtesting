<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT agentID, name, contact_name, address, city, state, zip, phone, fax, email, notes, active FROM mblxdev.tblagents ORDER BY name ASC ;");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name, $contactName, $address, $city, $state, $zip, $phone, $fax, $email, $notes, $active);
        $counter = 0;
        while ($statement->fetch()) {
            
            $data[$counter] = array(
                "id" => $id,
                "name" => $name,
                "contact_name" => $contactName,
                "address" => $address,
                "city" => $city,
                "state" => $state,
                "zip code" => $zip,
                "phone" => $phone,
                "fax" => $fax,
                
                "email" => $email,
                "notes" => $notes,
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