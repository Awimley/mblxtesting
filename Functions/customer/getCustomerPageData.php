<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        //$statement = $databaseConnection->prepare("SELECT customer_id, name, customer_code, contacts_list_id, phone_number, fax_number, address, city, state, post_code, country, email, active FROM mblxdev.tblcustomers");
        $statement = $databaseConnection->prepare("SELECT customer_id, name, customer_code, phone_number, fax_number, address, city, state, post_code, country, email, active FROM mblxdev.tblcustomers where active = 1");
       
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $custName, $custCode, $phone, $fax, $address, $city, $state, $postCode, $country, $email, $active);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $custName,
                "code" => is_null($custCode) ? "" : $custCode,
                "contacts_id" => '1',
                "phone" => is_null($phone) ? "" : $phone,
                "fax" => is_null($fax) ? "" : $fax,
                "address" =>is_null($address) ? "" : $address,
                "city" => is_null($city) ? "" : $city,
                "state" =>is_null($state) ? "" : $state,
                "postCode" => is_null($postCode) ? "" : $postCode,
                "country" => is_null($country) ? "" : $country,
                //"contracts_id" => $contractId,
                "email" => is_null($email) ? "" : $email,
                "active_status" => $active,
                "rank" => rand(1,1000)
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
