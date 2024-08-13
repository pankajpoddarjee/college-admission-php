<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from notices WHERE id=:id";
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

    $sql = "UPDATE notices SET is_active = :is_active WHERE id = :id";
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


//print_r($_POST); die;
$statusarr = [];
$action = sanitize_string($_POST["action"]);
$record_id = sanitize_string($_POST["record_id"]);

$notice_for = sanitize_string($_POST["notice_for"]);
$notice_title = sanitize_string($_POST["notice_title"]);
$college_id = !empty($_POST["college_id"])?$_POST["college_id"]:0;
$university_id = !empty($_POST["university_id"])?$_POST["university_id"]:0;;
$exam_id = !empty($_POST["exam_id"])?$_POST["exam_id"]:0;
$notice_date = sanitize_string($_POST["notice_date"]);

$is_new = sanitize_string($_POST["is_new"]);
$description = sanitize_string($_POST["description"]);
$tags = sanitize_string($_POST["tags"]);
$slug = sanitize_string($_POST["slug"]);

$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from notices WHERE slug=:slug and id!=:id"
    );
    $existQuery->bindParam(":slug", $slug, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This slug already exist";
        echo json_encode($statusarr);
        return;
    } else {
        
       
        $sql =
            "UPDATE notices SET notice_for = :notice_for, notice_title = :notice_title, college_id = :college_id,university_id = :university_id, exam_id = :exam_id, notice_date = :notice_date,is_new = :is_new, description = :description, tags = :tags, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":notice_for", $notice_for, PDO::PARAM_INT);
        $stmt->bindParam(":notice_title", $notice_title, PDO::PARAM_STR);       
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":notice_date", $notice_date, PDO::PARAM_STR);
        $stmt->bindParam(":is_new", $is_new, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        //$stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        // $stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);
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
        "select * from notices WHERE slug=:slug "
    );
    $existQuery->bindParam(":slug", $slug, PDO::PARAM_STR);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This slug already exist";
        echo json_encode($statusarr);
        return;
    } else {  
        
        
        
        $active_status = 1;
        $sql =
            "INSERT INTO notices (notice_for,notice_title,college_id,university_id,exam_id, notice_date,is_new, description, tags,created_at, created_by, is_active) VALUES (:notice_for, :notice_title, :college_id, :university_id, :exam_id, :notice_date, :is_new, :description, :tags,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        // $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        // $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":notice_for", $notice_for, PDO::PARAM_INT);
        $stmt->bindParam(":notice_title", $notice_title, PDO::PARAM_STR);       
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":notice_date", $notice_date, PDO::PARAM_STR);
        $stmt->bindParam(":is_new", $is_new, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);

        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

          
            $slug = "notice/".$slug;
            $slug= $slug."-".$id;
            
            $sql = "UPDATE notices SET slug = :slug WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();


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
