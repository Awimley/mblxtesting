<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        //$statement = $databaseConnection->prepare("SELECT customer_id, name, customer_code, contacts_list_id, phone_number, fax_number, address, city, state, post_code, country, email, active FROM mblxdev.tblcustomers");
        $statement = $databaseConnection->prepare(<<<SQL
        SELECT t.terminalID
	,t.NAME
	,t.mile_point
	,t.riverCode
	,CONCAT (
		c.NAME
		,', '
		,c.STATE
		) AS destination_name
	,t.contact_name
	,t.address
	,c.name
	,c.STATE
	,t.zip
	,t.phone
	,t.fax
	,t.notes
	,t.email
	,t.active
FROM mblxdev.tblterminals t inner join mblxdev.trefcities c on t.cityID = c.cityID
WHERE t.active = 1;
SQL
    );
        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $name, $milePoint, $river, $dest, $contact, $address, $city, $state, $zip, $phone, $fax, $notes, $email, $active);
        $counter = 0;
        while ($statement->fetch()) {
            
            $data[$counter] = array(
                "id" => $id,
                "name" => $name,
                "mile_point" => $milePoint,
                "river" => $river,
                "destination_city" => $dest,
                "contact_name" => $contact,
                "address" => $address,
                "city" => $city,
                "state" => $state,
                "zip_code" => $zip,
                "phone_number" => $phone,
                "fax" => $fax,
                "notes" => $notes,
                "email" => $email,
                "active_status" => $active
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
