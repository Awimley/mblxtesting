<?php
/* Specify the server and connection string attributes. */
$serverName = "tcp:le5zfb1ayg.database.windows.net,1433";

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
$tsql = "SELECT * from tblvessels";
$stmt = sqlsrv_query( $conn, $tsql);
if( $stmt === false )
{
     echo "Error in executing query.</br>";
     die( print_r( sqlsrv_errors(), true));
}

/* Retrieve and display the results of the query. */
while($rows = sqlsrv_fetch_array($stmt)) {
    echo $rows[0] . "\t" . $rows[1] . "<br />";
}

/* Free statement and connection resources. */
sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>