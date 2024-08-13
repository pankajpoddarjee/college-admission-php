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

if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from slug_master WHERE id=:id";
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

    $sql = "UPDATE colleges SET is_active = :is_active WHERE id = :id";
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

$banner_img = "";
$logo_img = "";
$title = sanitize_string($_POST["title"]);
$response_from = sanitize_string($_POST["response_from"]); 
$course_type_id = $_POST["course_type_id"];
$stream_id = sanitize_string($_POST["stream_id"]);
$college_type_id = sanitize_string($_POST["college_type_id"]);
$undertaking_id = sanitize_string($_POST["undertaking_id"]);
$university_id = sanitize_string($_POST["university_id"]);
$country_id = sanitize_string($_POST["country_id"]);
$state_id = sanitize_string($_POST["state_id"]);
$city_id = sanitize_string($_POST["city_id"]);
$district_id = sanitize_string($_POST["district_id"]);
$tags = sanitize_string($_POST["tags"]);
// $folder_name = sanitize_string($_POST["folder_name"]);
// $file_name = sanitize_string($_POST["file_name"]);
$slug = sanitize_string($_POST["slug"]);
//$slug = "college/".$slug;

$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from slug_master WHERE (title=:title or slug=:slug) and id!=:id"
    );
    $existQuery->bindParam(":title", $title, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->bindParam(":slug", $slug, PDO::PARAM_STR);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This title or slug already exist";
        echo json_encode($statusarr);
        return;
    } else {
      
        $sql = 
            "UPDATE slug_master SET title = :title, response_from = :response_from, course_type_id = :course_type_id, stream_id = :stream_id,college_type_id = :college_type_id,undertaking_id = :undertaking_id,university_id = :university_id, country_id = :country_id, state_id = :state_id, city_id = :city_id,district_id = :district_id,tags = :tags, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":response_from", $response_from, PDO::PARAM_STR);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_id", $stream_id, PDO::PARAM_INT);
        $stmt->bindParam(":college_type_id", $college_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":undertaking_id", $undertaking_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_id", $district_id, PDO::PARAM_INT);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
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
        "select * from slug_master WHERE title=:title OR slug=:slug"
    );
    $existQuery->bindParam(":title", $title, PDO::PARAM_STR);
    $existQuery->bindParam(":slug", $slug, PDO::PARAM_STR);
    $existQuery->execute();
    $existRecord = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($existRecord) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This title or slug already exist";
        echo json_encode($statusarr);
        return;
    } else {  
        
        
        
        $active_status = 1;
        $sql =
            "INSERT INTO slug_master (title,response_from,course_type_id, stream_id,college_type_id,undertaking_id,university_id,country_id,state_id,city_id,district_id,tags,slug, created_at, created_by) VALUES (:title, :response_from,:course_type_id, :stream_id,:college_type_id,:undertaking_id,:university_id, :country_id, :state_id, :city_id,:district_id,:tags,:slug,:created_at,:created_by)";
        $stmt = $dbConn->prepare($sql);
        // $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        // $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":response_from", $response_from, PDO::PARAM_STR);
        $stmt->bindParam(":course_type_id", $course_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":stream_id", $stream_id, PDO::PARAM_INT);
        $stmt->bindParam(":college_type_id", $college_type_id, PDO::PARAM_INT);
        $stmt->bindParam(":undertaking_id", $undertaking_id, PDO::PARAM_INT);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
        $stmt->bindParam(":city_id", $city_id, PDO::PARAM_INT);
        $stmt->bindParam(":district_id", $district_id, PDO::PARAM_INT);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
      
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
