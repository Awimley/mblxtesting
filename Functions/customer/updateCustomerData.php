<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $custId = $code = $name = $phone = $fax = $address = $city = $state = $postCode = $country = $email = $activeStatus = "";


     
   

    include('../database_access.php');
    try {
       
      //$query_insert_customer = ;
      $statement = $databaseConnection->prepare("UPDATE mblxdev.tblcustomers SET name = ?,customer_code = ?,phone_number = ?,	fax_number = ?,	address = ?,city = ?, state = ?, post_code = ?,	country = ?, email = ?,	active = ? WHERE customer_id= ? ");
      $statement->bind_param('ssssssssssii', $name, $code, $phone, $fax, $address, $city, $state, $postCode, $country, $email, $activeStatus, $custId);
      $custId = test_input($dataPosted["custId"]);
      $code = test_input($dataPosted["code"]);
      $name = test_input($dataPosted["name"]);
      $phone = test_input($dataPosted["phone"]);
      $fax = test_input($dataPosted["fax"]);
      
      $address = test_input($dataPosted["address"]);
      $city = test_input($dataPosted["city"]);
      $state = test_input($dataPosted["state"]);
      $postCode = test_input($dataPosted["postCode"]);
      $country = test_input($dataPosted["country"]);
      $email = test_input($dataPosted["email"]);
      $activeStatus = test_input($dataPosted["active_status"]);
       
        $statement->execute();
   
        if ($statement->error) {
            $errorData = "Database query failed: " . $statement->error;
            die(json_encode($errorData));
        } else {
           $returnJson = array(
                "status" => "okay"
                
            );
            echo json_encode($returnJson);
        }
      
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
