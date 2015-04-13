<?php
header('Content-Type: text/html');
//$dataPosted = json_decode(file_get_contents('php://input'), true);


$bargeID = 1;

checkIfActiveExistsAndIfSoReturnTheFileNumber($bargeID);



function checkIfActiveExistsAndIfSoReturnTheFileNumber($bargeId) {
    

        include('../database_access.php');
        

        
        if ($result = mysqli_query($databaseConnection, "select barge_file_number from mblxdev.trefbargefilenumbers where active = 1 and bargeID = $bargeId ")) {

            /* determine number of rows result set */
            $row_cnt = mysqli_num_rows($result);

            printf("Result set has %d rows.\n", $row_cnt);

            /* close result set */
            mysqli_free_result($result);
        }

        /* close connection */
        mysqli_close($databaseConnection);
        
        
        
        
    
    
    
    
}
?>
