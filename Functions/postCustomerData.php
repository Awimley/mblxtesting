<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $name = $email = $address = $city = "";

    
      $name = test_input($dataPosted["name"]);
      $email = test_input($dataPosted["email"]);
      $address = test_input($dataPosted["address"]);
      $city = test_input($dataPosted["city"]);
     
   

    include('database_access.php');
    try {
        $query_insert_customer = "INSERT INTO mblxdev.tblcustomers (name, address, city, email) VALUES ('$name', '$address', '$city', '$email')";
       $statement = $databaseConnection->prepare($query_insert_customer);
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
