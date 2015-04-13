<?php
    header('Content-Type: application/json');
    include('../database_access.php');
    try {
    
        $data = array();
        $returnData = array();
        $statement = $databaseConnection->prepare(<<<SQL
                SELECT
	b.bargeID,
	b.bargeLineID,
    bl.name,
	b.barge_number,
	b.barge_type,
	b.cover_type,
	b.notes,
	b.active
FROM
	mblxdev.trefbarges b inner join mblxdev.tblbargelines bl on b.bargeLineId = bl.bargeLineId;
	
SQL
);
        $statement->execute();
        
    
        if ($statement->error) {
            die("Database query failed: " . $statement->error);
        }
    
        $statement->bind_result($id, $bargeLineID, $bargeLineName, $bargeNumber, $bargeType, $coverType, $notes, $active);
        $counter = 0;
        while ($statement->fetch()) {
            $bargeDraftData = getBargeDraft($id);
            $data[$counter] = array(
                "id" => $id,
                "barge_line_id" => $bargeLineID,
                "barge_line_name" => $bargeLineName,
                "barge_number" => $bargeNumber,
                "barge_type" => $bargeType,
                "cover_type" => $coverType,
                "draft_data" => $bargeDraftData,
                "notes" => $notes,
                "active" => $active

            );
            $counter++;
           
          
        }
        $returnData['data'] = $data;
        echo json_encode($returnData, JSON_PRETTY_PRINT);
    }

    catch (PDOException $e) {
        echo $e->getMessage();
    }
   
    function getBargeDraft($bargeId) {
    include('../more_database_access.php');
    $returnData = array();
        $state = $databaseConnection2->prepare(<<<SQL

SELECT
	bargeDraftID,
	isEmpty,
	isMax,
	feet,
	inches,
	draft_value,
	
	notes,
    active
FROM
	mblxdev.trefbargedrafts
WHERE bargeID = $bargeId
SQL
);
        $state->execute();
        
    
        if ($state->error) {
            die("Database query failed: " . $state->error);
        }
    
        $state->bind_result($id, $isEmpty, $isMax, $feet, $inches, $value, $notes, $active);
        $counter = 0;
        while ($state->fetch()) {
             
            $returnData[$counter] = array(
                "id" => $id,
                "is_empty" => $isEmpty,
                "is_max" => $isMax,
                "feet"=> $feet,
                "inches" => $inches,
                "value" => $value,
                "notes" => $notes,
                "active" => $active

            );
            $counter++;
           
          
        }
        return $returnData;
    }
?>