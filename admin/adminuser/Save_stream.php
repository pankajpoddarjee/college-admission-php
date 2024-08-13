<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select id,course_type_id,stream_name,short_name,is_active from streams WHERE id=:id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
    $stmt->execute();

    $qryresult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($qryresult) {
        $statusarr["status"] = 1;
        $statusarr["record"] = $qryresult;
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] =
            "There is some problem with the data. Please Try again";
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

    $sql = "UPDATE streams SET is_active = :is_active WHERE id = :id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":is_active", $newStatus, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

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
$course_type_id = sanitize_string($_POST["course_type_id"]);  
$stream_name = sanitize_string($_POST["stream_name"]);  
$short_name = sanitize_string($_POST["short_name"]);
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from streams WHERE (stream_name=:stream_name OR short_name=:short_name) and id!=:id"
    );
    $existQuery->bindParam(":stream_name", $stream_name, PDO::PARAM_STR);
    $existQuery->bindParam(":short_name", $short_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This strean already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $sql =
            "UPDATE streams SET course_type_id = :course_type_id,stream_name = :stream_name,short_name = :short_name,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_name", $stream_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
        $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Record updated successfully  ";
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";           
        }
		echo json_encode($statusarr);
		return;
    }
} else {
    $existQuery = $dbConn->prepare(
        "select * from streams WHERE (stream_name=:stream_name OR short_name=:short_name)"
    );
    $existQuery->bindParam(":stream_name", $stream_name, PDO::PARAM_STR);
    $existQuery->bindParam(":short_name", $short_name, PDO::PARAM_STR);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This stream already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $active_status = 1;
        $sql =
            "INSERT INTO streams (course_type_id,stream_name,short_name, created_at, created_by, is_active) VALUES (:course_type_id, :stream_name,:short_name, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_name", $stream_name, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $statusarr["status"] = 1;
            $statusarr["msg"] = "Data inserted successfully";
        } else {
            $statusarr["status"] = 0;
            $statusarr["msg"] =
                "There is some problem with the data. Please Try again";
           
        }
		echo json_encode($statusarr);
		return;
    }
}

?>
