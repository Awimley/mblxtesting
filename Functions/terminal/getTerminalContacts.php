<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare("SELECT tc.terminalContactID, t.terminal_name, tc.name, tc.phone, tc.email FROM mblxdev.tblterminalcontacts tc inner join mblxdev.tblTerminals t on tc.terminalID = t.terminalID");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $termName, $name, $phone, $email);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "terminal_name" => $termName,
                "name" => $name,
                
                "phone" => $phone,
                "email" => $email
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
