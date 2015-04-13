<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $custId = "";


     
   

    include('../database_access.php');
    try {
        $data = array();
       //$query_insert_customer = ;
       $statement = $databaseConnection->prepare("select contact_id, name, phone, email from mblxdev.tblcontacts WHERE customer_id= ? ");
       $statement->bind_param('i', $custId);
              $custId = test_input($dataPosted["custId"]);
      
       
        $statement->execute();
        $statement->bind_result($id, $name, $phone, $email);
        $counter = 0;
        while ($statement->fetch()) {
          
            $data[$counter] = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "email" => $email
            );
            $counter++;
           
          
        }
        if ($statement->error) {
            $errorData = "Database query failed: " . $statement->error;
            die(json_encode($errorData));
        } else {
           echo json_encode($data, JSON_PRETTY_PRINT);
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
