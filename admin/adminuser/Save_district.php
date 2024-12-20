<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["getState"])) {
    $qryresult = [];
    $country_id = $_GET["getState"];
	$is_active = 1;
    $sql = "select id,state_name from states WHERE country_id=:country_id AND is_active=:is_active";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
    $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // if ($qryresult) {
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

if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select id,country_id,state_id,district_name,is_active from districts WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "There is some problem with the data. Please Try again";
    }
    $dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["statusid"])) {
    $id = $_GET["statusid"];
    $status = $_GET["status"];
    if ($status == 1) {
        $newStatus = 0;
    } else {
        $newStatus = 1;
    }

    $sql = "UPDATE districts SET is_active = :is_active WHERE id = :id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":is_active", $newStatus, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    //$stmt->execute();

    if ($stmt->execute()) {
        $statusarr["status"] = 1;
        $statusarr["msg"] = "Record updated successfully";
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] =
            "There is some problem with the data. Please Try again";
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
$district_name = sanitize_string($_POST["district_name"]);
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from districts WHERE district_name=:district_name and id!=:id"
    );
    $existQuery->bindParam(":district_name", $district_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This district already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $sql =
            "UPDATE districts SET country_id = :country_id, state_id = :state_id, district_name = :district_name, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_name", $district_name, PDO::PARAM_STR);
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
        "select * from districts WHERE district_name=:district_name"
    );
    $existQuery->bindParam(":district_name", $district_name, PDO::PARAM_STR);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This district already exist";
        echo json_encode($statusarr);
        return;
    } else {        
        $active_status = 1;
        $sql =
            "INSERT INTO districts (country_id, state_id, district_name, created_at, created_by, is_active) VALUES (:country_id, :state_id, :district_name, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_name", $district_name, PDO::PARAM_STR);
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
