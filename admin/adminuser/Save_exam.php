<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";

if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from exams WHERE id=:id";
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

    $sql = "UPDATE exams SET is_active = :is_active WHERE id = :id";
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
$banner_img = "";
$logo_img = "";
$html_page ="";
$action = sanitize_string($_POST["action"]);
$record_id = sanitize_string($_POST["record_id"]);
$exam_name = sanitize_string($_POST["exam_name"]);
$about_exam = sanitize_string($_POST["about_exam"]);
$exam_level = sanitize_string($_POST["exam_level"]);
$exam_type_name = sanitize_string($_POST["exam_type_name"]);
$exam_category_name = sanitize_string($_POST["exam_category_name"]);
$country_name = sanitize_string($_POST["country_name"]);
$state_name = sanitize_string($_POST["state_name"]);
$short_name = sanitize_string($_POST["short_name"]);
$slug = sanitize_string($_POST["slug"]);
$tags = sanitize_string($_POST["tags"]);
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from exams WHERE exam_name=:exam_name and id!=:id"
    );
    $existQuery->bindParam(":exam_name", $exam_name, PDO::PARAM_STR);
    $existQuery->bindParam(":id", $record_id, PDO::PARAM_INT);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This exam already exist";
        echo json_encode($statusarr);
        return;
    } else {

        $sql = "select * from exams WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $examRec = $stmt->fetch(PDO::FETCH_ASSOC);

        $banner_img = $examRec['banner_img'];
        
        if(isset($_FILES['banner_img']['name']) && !empty($_FILES['banner_img']['name'])){

           
            $errors = validateBannerImage($_FILES['banner_img']);

            if (empty($errors)) {
                $slugWithCollege = $slug;
                $slugWithoutCollege = str_replace("exams/", "", $slugWithCollege);

				$ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['banner_img']['tmp_name'];
                $banner_file_name = $slugWithoutCollege.'.'.$ext;
                $newFilePath = "../../uploads/exam/banner_image/" .$banner_file_name;

                if($examRec && !empty($examRec['banner_img']) && isset($examRec['banner_img']) && $examRec['banner_img'] !=''){
                    if (file_exists("../../uploads/exam/banner_image/".$examRec['banner_img'])) {
                        unlink("../../uploads/exam/banner_image/".$examRec['banner_img']);
                    }
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $banner_img = $banner_file_name;
                    
                }  
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
        }
        $logo_img = $examRec['logo_img'];

        if(isset($_FILES['logo_img']['name']) && !empty($_FILES['logo_img']['name'])){
            $errors = validateLogoImage($_FILES['logo_img']);
            if (empty($errors)) {

                $slugWithCollege = $slug;
                $slugWithoutCollege = str_replace("exams/", "", $slugWithCollege);

				$ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
                //echo "oankaj".$ext;
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['logo_img']['tmp_name'];
                $logo_file_name = $slugWithoutCollege.'-logo.'.$ext;
               // echo $logo_file_name;
                $newFilePath = "../../uploads/exam/logo_image/" .$logo_file_name;

                if(!empty($examRec['logo_img']) && isset($examRec['logo_img']) && $examRec['logo_img'] !=''){
                    if (file_exists("../../uploads/exam/logo_image/". $examRec['logo_img'])) {unlink("../../uploads/exam/logo_image/". $examRec['logo_img']);}
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $logo_img = $logo_file_name;
                    
                }          
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
        }
        $html_page = $examRec['html_page'];
        if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){
            $errors = validateNoticePage($_FILES['html_page']);
            if (empty($errors)) {

                $slugWithCollege = $slug;
                $slugWithoutCollege = str_replace("exams/", "", $slugWithCollege);

				$ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
                //echo "oankaj".$ext;
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['html_page']['tmp_name'];
                $page_file_name = $slugWithoutCollege.'-page.'.$ext;
               // echo $page_file_name;
                $newFilePath = "../../uploads/exam/html_page/" .$page_file_name;

                if(!empty($examRec['html_page']) && isset($examRec['html_page']) && $examRec['html_page'] !=''){
                    if (file_exists("../../uploads/exam/html_page/". $examRec['html_page'])) {unlink("../../uploads/exam/html_page/". $examRec['html_page']);}
                }
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $html_page = $page_file_name;
                    
                }          
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
        }
        $sql = 
            "UPDATE exams SET exam_level = :exam_level,exam_type_name = :exam_type_name,exam_category_name = :exam_category_name,country_name = :country_name,state_name = :state_name,banner_img = :banner_img,logo_img = :logo_img,html_page = :html_page, exam_name = :exam_name, about_exam = :about_exam,short_name = :short_name,tags = :tags,updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":exam_level", $exam_level, PDO::PARAM_STR);
        $stmt->bindParam(":exam_type_name", $exam_type_name, PDO::PARAM_STR);
        $stmt->bindParam(":exam_category_name", $exam_category_name, PDO::PARAM_STR);
        $stmt->bindParam(":country_name", $country_name, PDO::PARAM_STR);
        $stmt->bindParam(":state_name", $state_name, PDO::PARAM_STR);
        $stmt->bindParam(":exam_name", $exam_name, PDO::PARAM_STR);
        $stmt->bindParam(":about_exam", $about_exam, PDO::PARAM_STR);
        $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
        $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
        $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
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
        "select * from exams WHERE exam_name=:exam_name"
    );
    $existQuery->bindParam(":exam_name", $exam_name, PDO::PARAM_STR);
    $existQuery->execute();
    $Record = $existQuery->fetch(PDO::FETCH_ASSOC);
    if ($Record) {
        $statusarr["status"] = 0;
        $statusarr["msg"] = "This exam already exist";
        echo json_encode($statusarr);
        return;
    } else {
        $active_status = 1;
        $sql =
            "INSERT INTO exams (exam_name,about_exam,exam_level,exam_type_name,exam_category_name,country_name,state_name,short_name,tags,created_at, created_by, is_active) VALUES (:exam_name,:about_exam,:exam_level,:exam_type_name,:exam_category_name,:country_name,:state_name,:short_name,:tags, :created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":exam_level", $exam_level, PDO::PARAM_STR);
        $stmt->bindParam(":exam_type_name", $exam_type_name, PDO::PARAM_STR);
        $stmt->bindParam(":exam_category_name", $exam_category_name, PDO::PARAM_STR);
        $stmt->bindParam(":country_name", $country_name, PDO::PARAM_STR);
        $stmt->bindParam(":state_name", $state_name, PDO::PARAM_STR);

        $stmt->bindParam(":exam_name", $exam_name, PDO::PARAM_STR);
        $stmt->bindParam(":about_exam", $about_exam, PDO::PARAM_STR);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $active_status, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

            if(isset($_FILES['banner_img']['name']) && !empty($_FILES['banner_img']['name'])){

                $errors = validateBannerImage($_FILES['banner_img']);

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['banner_img']['tmp_name'];
                    $banner_file_name = $slug."-".$id.'.'.$ext;
					$newFilePath = "../../uploads/exam/banner_image/" .$banner_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $banner_img = $banner_file_name;
                    } 
                } else {

                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }

                  
            }
            
            if(isset($_FILES['logo_img']['name']) && !empty($_FILES['logo_img']['name'])){
                $errors = validateLogoImage($_FILES['logo_img']);
                if (empty($errors)) {
                    $ext = pathinfo($_FILES['logo_img']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['logo_img']['tmp_name'];
                    $logo_file_name = $slug."-".$id.'-logo.'.$ext;
					$newFilePath = "../../uploads/exam/logo_image/" .$logo_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $logo_img = $logo_file_name;              
                    }           
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }
            }

            if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){
                $errors = validateNoticePage($_FILES['html_page']);
                if (empty($errors)) {
                    $ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['html_page']['tmp_name'];
                    $page_file_name = $slug."-".$id.'-page.'.$ext;
					$newFilePath = "../../uploads/exam/html_page/" .$page_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $html_page = $page_file_name;              
                    }           
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }
            }

           
            $slug = "exams/".$slug;
            if(!empty($short_name) && $short_name!="" && isset($short_name)){
                $slug= $slug."-".generateSlug($short_name);
            }

            $slug= $slug."-".$id;

            $sql = "UPDATE exams SET banner_img = :banner_img,logo_img = :logo_img,html_page = :html_page, slug = :slug WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":banner_img", $banner_img, PDO::PARAM_STR);
            $stmt->bindParam(":logo_img", $logo_img, PDO::PARAM_STR);
            $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

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
