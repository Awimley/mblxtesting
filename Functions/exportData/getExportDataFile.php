<?php
header('Content-Type: text/tab-separated-values');
header('Content-Disposition: inline; filename="myfile.tsv"');

    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare(<<<SQL
       SELECT b.booking_company
	    ,b.booking_number
	    ,cust.NAME
	    ,cc.contract_number
	    ,serv.service_desc
    FROM tblbookings b
    LEFT JOIN tblcustomers cust ON b.customerId = cust.customer_id
    LEFT JOIN tblcontracts cc ON b.customer_contractId = cc.contractId
    LEFT JOIN tblservices serv ON b.serviceId = serv.serviceID;
SQL
);

        $statement->execute();
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($bookingCompany, $bookingNumber, $customerName, $contractNumber, $serviceDesc);
       // $counter = 0;
        echo "booking_company\tbooking_number\tcustomer_name\tcontract_number\tservice_description\n";



        while ($statement->fetch()) {
          
           echo $bookingCompany . "\t" . $bookingNumber . "\t" . $customerName . "\t" . $contractNumber . "\t" . $serviceDesc . "\n";
           
          
        }
       
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   
?>
