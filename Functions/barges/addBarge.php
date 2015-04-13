<?php
header('Content-Type: application/json');
$dataPosted = json_decode(file_get_contents('php://input'), true);

$bargeLineId = $bargeNumber = $bargeType = $coverType = $maxDraftFeet = $maxDraftInches = $emptyDraftFeet = $emptyDraftInches = "";





include('../database_access.php');
try {
    
    //$query_insert_customer = ;
    $statement = $databaseConnection->prepare("INSERT INTO mblxdev.trefbarges(bargeLineID, barge_number, barge_type, cover_type, notes, active) VALUES (?, ?, ?, ?, 'TEST', 1)");
    $statement->bind_param('isss', $bargeLineId, $bargeNumber, $bargeType, $coverType);
    
    $bargeLineId  = test_input($dataPosted["barge_line_id"]);
    $bargeNumber  = test_input($dataPosted["barge_number"]);
    $bargeType = test_input($dataPosted["barge_type"]);
    $coverType    = test_input($dataPosted["cover_type"]);
    $maxDraftFeet = test_input($dataPosted["maxDraftFeet"]);
    $maxDraftInches = test_input($dataPosted["maxDraftInches"]);
    $emptyDraftFeet = test_input($dataPosted["emptyDraftFeet"]);
    $emptyDraftInches = test_input($dataPosted["emptyDraftInches"]);
    
    
    
    $draftz = $dataPosted["drafts"];
    
    
    
    $statement->execute();
    $last_id = $databaseConnection->insert_id;
    
    
    
    if ($statement->error) {
        $errorData = "Database query failed: " . $statement->error;
        die(json_encode($errorData));
    } else {
        $insertMaxStatus = insertMaxDraft($last_id, $maxDraftFeet, $maxDraftInches);
        $insertEmptyStatus = insertEmptyDraft($last_id, $emptyDraftFeet, $emptyDraftInches);
        $insertDraftsStatus = insertDrafts($last_id, $draftz);
        if ($insertMaxStatus && $insertEmptyStatus) {
            $returnJson = array(
               "status" => "okay"
               
           );
            echo json_encode($returnJson);
        }
       
    }
    
}

catch (PDOException $e) {
    echo $e->getMessage();
}

function insertDrafts($bargeId, $draftArray) {
    
    foreach ($draftArray as $draft) {
        $feet = $draft["feet"];
        $inches = $draft["inches"];
        $value = $draft["value"];
        try {
            include('../more_database_access.php');
            $statement2 = $databaseConnection2->prepare(<<<SQL
    INSERT INTO mblxdev.trefbargedrafts
	(bargeID, isEmpty, isMax, feet, inches, draft_value, active)
VALUES 
	(?, 0, 0, ?, ?, ?, 1);
SQL
        );
            $statement2->bind_param('iiii', $bargeIdP, $feetP, $inchesP, $valueP);
            $bargeIdP = $bargeId;
            $feetP = $feet;
            $inchesP = $inches;
            $valueP = $value;
            $statement2->execute();
            if ($statement2->error) {
                $errorData = "Database query failed: " . $statement2->error;
                die(json_encode($errorData));
            } else {
                $databaseConnection2->close();
                
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }
    
}

function insertMaxDraft($bargeId, $feet, $inches) {
    try {
        include('../more_database_access.php');
        $statement2 = $databaseConnection2->prepare(<<<SQL
    INSERT INTO mblxdev.trefbargedrafts
	(bargeID, isEmpty, isMax, feet, inches, active)
VALUES 
	(?, 0, 1, ?, ?, 1);
SQL
    );
        $statement2->bind_param('iii', $bargeIdP, $feetP, $inchesP);
        $bargeIdP = $bargeId;
        $feetP = $feet;
        $inchesP = $inches;
        $statement2->execute();
        if ($statement2->error) {
            $errorData = "Database query failed: " . $statement2->error;
            die(json_encode($errorData));
        } else {
            $databaseConnection2->close();
            return true;
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}


function insertEmptyDraft($bargeId, $feet, $inches) {
    try {
        include('../more_database_access.php');
        $statement2 = $databaseConnection2->prepare(<<<SQL
    INSERT INTO mblxdev.trefbargedrafts
	(bargeID, isEmpty, isMax, feet, inches, active)
VALUES 
	(?, 1, 0, ?, ?, 1);
SQL
    );
        $statement2->bind_param('iii', $bargeIdP, $feetP, $inchesP);
        $bargeIdP = $bargeId;
        $feetP = $feet;
        $inchesP = $inches;
        $statement2->execute();
        if ($statement2->error) {
            $errorData = "Database query failed: " . $statement2->error;
            die(json_encode($errorData));
        } else {
            $databaseConnection2->close();
            return true;
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>