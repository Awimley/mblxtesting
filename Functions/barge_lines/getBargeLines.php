<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT bargeLineID, name, contact, address, city, state, zip, phone, notes FROM tblbargelines");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name, $contact, $address, $city, $state, $zip, $phone, $notes);
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
                "notes" => $notes
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