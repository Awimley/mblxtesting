<?php
header('Content-Type: application/json');
/* Specify the server and connection string attributes. */
$serverName = "le5zfb1ayg.database.windows.net";

/* Get UID and PWD from application-specific files.  */
$uid = "btcadmin@le5zfb1ayg";
$pwd = "{22whodat\$%}";
$connectionInfo = array( "UID"=>$uid,
                         "PWD"=>$pwd,
                         "Database"=>"mblx_sql_azure");

/* Connect using SQL Server Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false )
{
     echo "Unable to connect.</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* Query SQL Server for the login of the user accessing the
database. */
    $data = array();
    $returnData = array();
    $tsql = "SELECT stevedoreID, name, contact_name, address, city, state, zip, phone, fax, email, notes, active FROM tblstevedores where active=1;";
    $stmt = sqlsrv_query( $conn, $tsql);
    if( $stmt === false )
    {
        echo "Error in executing query.</br>";
        die( print_r( sqlsrv_errors(), true));
    }

    /* Retrieve and display the results of the query. */
         $counter = 0;
   
    while($rows = sqlsrv_fetch_array($stmt)) {
         $data[$counter] = array(
            "id" => $rows[0],
            "name" => $rows[1],
            "contact_name" => $rows[2],
            "address" => $rows[3],
            "city" => $rows[4],
            "state" => $rows[5],
            "zip_code" => $rows[6],
            "phone_number" => $rows[7],
            "fax" => $rows[8],
            "email" => $rows[9],
            "notes" => $rows[10],
            "active" => $rows[11]);
         
         
        
        $counter++;
    }
   
    $returnData['data'] = $data;
    echo json_encode($returnData, JSON_PRETTY_PRINT);

sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>