<?php

    header('Content-Type: application/json');
    $dataPosted = json_decode(file_get_contents('php://input'), true);
    $name = $email = $address = $city = "";

    
      $name = test_input($dataPosted["name"]);
     
     
   

    define('DB_NAME', 'mblxdev');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'jup5iter!');
    define('DB_HOST', '69.28.90.21');

    define('DEFAULT_ADMIN_USERNAME', 'root');
    define('DEFAULT_ADMIN_PASSWORD', 'jup5iter!');
    $databaseConnection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($databaseConnection->connect_error) {
        die("Database selection failed: " . $databaseConnection->connect_error);
    }
    try {
        $query_insert_vessel = "INSERT INTO mblxdev.tblvessels (vessel_name) VALUES ('$name')";
       $statement = $databaseConnection->prepare($query_insert_vessel);
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
