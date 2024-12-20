<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["bug_id"])) {
    $updated_at = date("Y-m-d H:i:s");
    $updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $bug_id = $_GET["bug_id"];
    $is_read = 1;
    $sql = "UPDATE report_problem SET is_read = :is_read,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":is_read", $is_read, PDO::PARAM_STR);
    $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
    $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);
    $stmt->bindParam(":id", $bug_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $statusarr["status"] = 1;
        $statusarr["msg"] = "Record updated successfully  ";
    } else {
        $statusarr["status"] = 0;
        $statusarr["msg"] =
            "There is some problem with the data. Please Try again";           
    }
	$dbConn= NULL;
    echo json_encode($statusarr);
    return;
}

if (isset($_GET["update_all_bug_id"])) {
    $updated_at = date("Y-m-d H:i:s");
    $updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $is_read = 1;
    $sql = "UPDATE report_problem SET is_read = :is_read,updated_at = :updated_at,updated_by = :updated_by ";
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(":is_read", $is_read, PDO::PARAM_STR);
    $stmt->bindParam(":updated_at", $updated_at, PDO::PARAM_STR);
    $stmt->bindParam(":updated_by", $updated_by, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $statusarr["status"] = 1;
        $statusarr["msg"] = "All record updated successfully  ";
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
$record_id = sanitize_string($_POST["record_id"]);
$status = sanitize_string($_POST["status"]);
$created_at = date("Y-m-d H:i:s"); 
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";


$sql =
    "UPDATE report_problem SET status = :status,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(":status", $status, PDO::PARAM_STR);
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
    


?>
