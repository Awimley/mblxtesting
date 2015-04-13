<?php
    include('database_access.php');
    header('Content-Type: application/json');
    
    try {
    
        $data = array();
        
         $statement = $databaseConnection->prepare("SELECT customer_id, name, customer_code, contacts_list_id, phone_number, fax_number, address, city, state, post_code, country, contract_id, email FROM mblxdev.tblcustomers");
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $custName, $custCode, $contactsId, $phone, $fax, $address, $city, $state, $postCode, $country, $contractId, $email);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $custName,
                "code" => $custCode,
                "contacts_id" => $contactsId,
                "phone" => $phone,
                "fax" => $fax,
                "address" => $address,
                "city" => $city,
                "state" => $state,
                "postCode" => $postCode,
                "country" => $country,
                "contracts_id" => $contractId,
                "email" => $email,
                "rank" => rand(1,1000)
            );
            $counter++;
           
          
        }
        echo json_encode($data);
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   
?>
