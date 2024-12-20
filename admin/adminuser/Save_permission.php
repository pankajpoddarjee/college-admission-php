<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";
//session_start(); 
if (isset($_GET["getUsers"])) {
   // echo $_SESSION["userid"];
    $qryresult = [];
    $user_type_id = $_GET["getUsers"];
	$is_active = 1;
    $sql = "select * from users_admin WHERE userType=:user_type_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":user_type_id", $user_type_id, PDO::PARAM_INT);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
    // } else {
    //     $statusarr["status"] = 0;
    //     $statusarr["msg"] = "There is some problem with the data. Please Try again";
    // }
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}



if (isset($_GET["add_permission"])) {
    $mid = $_GET["add_permission"];
    $uid = $_GET["user_id"];


    $sql = "select * from permissions WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $mid, PDO::PARAM_INT);
    $stmt->execute();
    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    if($qryresult){

        if(isset($qryresult['user_ids'])){
            
                $aArray = explode(',', $qryresult['user_ids']);
                array_push($aArray, $uid);
                $unique_ids = array_unique($aArray);
    
                $user_ids = ltrim(implode(',', $unique_ids), ",");
          
        }else{
            $user_ids = $uid;
        }

        $sql = "UPDATE permissions SET user_ids = :user_ids WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":user_ids", $user_ids, PDO::PARAM_STR);
        $stmt->bindParam(":id", $mid, PDO::PARAM_INT);
        //$stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully";
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
        }

    }
    
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["remove_permission"])) {
    $mid = $_GET["remove_permission"];
    $uid = $_GET["user_id"];


    $sql = "select * from permissions WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $mid, PDO::PARAM_INT);
    $stmt->execute();
    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    if($qryresult){

        if(isset($qryresult['user_ids'])){
            
                $aArray = explode(',', $qryresult['user_ids']);
                $newArray = array_filter($aArray, function ($value) use ($uid) {
                    return $value !== $uid;
                });
                $unique_ids = array_unique($newArray);
    
                $user_ids = ltrim(implode(',', $unique_ids), ",");
          
        }else{
            $user_ids = $uid;
        }

        $sql = "UPDATE permissions SET user_ids = :user_ids WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":user_ids", $user_ids, PDO::PARAM_STR);
        $stmt->bindParam(":id", $mid, PDO::PARAM_INT);
        //$stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully";
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
        }

    }
    
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}


$statusarr = [];
$action = sanitize_string($_POST["action"]);
$record_id = sanitize_string($_POST["record_id"]);
$country_id = sanitize_string($_POST["country_id"]);
$state_id = sanitize_string($_POST["state_id"]);
$city_name = sanitize_string($_POST["city_name"]);
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from cities WHERE city_name=:city_name and id!=:id"
    );
    $existQuery->bindParam(":city_name", $city_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This city already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $sql =
            "UPDATE cities SET country_id = :country_id, state_id = :state_id, city_name = :city_name, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_name", $city_name, PDO::PARAM_STR);
        $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
        $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        // $stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully  ";
            echo json_encode($statusarr);
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
            echo json_encode($statusarr);
        }
    }
    $dbConn= NULL;
} else {
    $existQuery = $dbConn->prepare(
        "select * from cities WHERE city_name=:city_name"
    );
    $existQuery->bindParam(":city_name", $city_name, PDO::PARAM_STR);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This city already exist";
        echo json_encode($statusarr);
        return;
    } else {        
        $active_status = 1;
        $sql =
            "INSERT INTO cities (country_id, state_id, city_name, created_at, created_by, is_active) VALUES (:country_id, :state_id, :city_name, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_name", $city_name, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        //$stmt->execute();

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
            echo json_encode($statusarr);
            return;
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
            echo json_encode($statusarr);
            return;
        }
    }
    $dbConn= NULL;
}

?>
