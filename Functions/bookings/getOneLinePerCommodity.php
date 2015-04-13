<?php
header('Content-Type: text/html');
include('../database_access.php');
try {
    
    $data = array();
    $returnData = array();
    $statement = <<<SQL
    SELECT b.bookingId AS bookingId
	,b.STATUS AS booking_status
	,b.booking_number AS booking_number
	,b.booking_company AS booking_company
	,cust.NAME AS customer_name
	,a.NAME AS agent_name
	,v.vessel_name AS vessel_name
	,vt.eta_date AS eta_date
	,w.NAME AS wharf_name
	,stev.NAME AS stevedore_name
	,ci.name as dest_name
	,t.NAME AS terminal_name
	,serv.service_name AS service_name,trf.trefbooking_commoditiesId, trf.commodityId, c.name, trf.piece_count, trf.tonnage, trf.bill_lading
FROM 

									mblxdev.tblbookings b INNER JOIN mblxdev.tblcustomers cust ON ((b.customerId = cust.customer_id))
									 INNER JOIN mblxdev.tblvesseltrip vt ON ((b.vesselTripId = vt.vesselTripID))
								 INNER JOIN mblxdev.tblagents a ON ((vt.agentID = a.agentID))
						INNER JOIN mblxdev.tblvessels v ON ((vt.vesselID = v.vesselID))
						INNER JOIN mblxdev.tblwharves w ON ((vt.wharfID = w.wharfID))
					INNER JOIN mblxdev.tblstevedores stev ON ((vt.stevedoreID = stev.stevedoreID))
				INNER JOIN mblxdev.tbldestinations d ON ((b.destinationId = d.destinationID))
				inner join mblxdev.trefcities ci on ((d.cityID = ci.cityID))
		 INNER JOIN mblxdev.tblterminals t ON ((b.terminalId = t.terminalID))
		INNER JOIN mblxdev.tblservices serv ON ((b.serviceId = serv.serviceID))
		RIGHT OUTER join mblxdev.trefbooking_commodities trf on b.bookingId = trf.bookingId
		inner join tblcommodities c on trf.commodityId = c.commodityID;
SQL;
    $result = $databaseConnection->query($statement);
    
   
    
    if ($statement->error) {
        die("Database query failed: " . $statement->error);
    }
    
    //$statement->bind_result($bookingId, $booking_status, $booking_number, $customer_name, $agent_name, $vessel_name, $eta_date, $wharf_name, $stevedore_name, $destination_name, $terminal_name, $);
    $counter = 0;
   while ($row = $result->fetch_array(MYSQLI_NUM)) {
        
       var_dump($row);
        
    }
    
}

catch (PDOException $e) {
    echo $e->getMessage();
}

?>
