<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from notice_colleges WHERE id=:id";
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

    $sql = "UPDATE notice_colleges SET is_active = :is_active WHERE id = :id";
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
$course_for = sanitize_string($_POST["course_for"]);
$notice_category = sanitize_string($_POST["notice_category"]);
$notice_title = sanitize_string($_POST["notice_title"]);
$college_id = !empty($_POST["college_id"])?$_POST["college_id"]:0;

$notice_type = sanitize_string($_POST["notice_type"]);
$page_link = "";
$url_link = sanitize_string($_POST["url_link"]);
$has_attachment = sanitize_string($_POST["has_attachment"]);
$notice_date = sanitize_string($_POST["notice_date"]);
$is_new = sanitize_string($_POST["is_new"]);
$is_active = sanitize_string($_POST["is_active"]);
$description = sanitize_string($_POST["description"]);
$tags = sanitize_string($_POST["tags"]);
$slug = isset($_POST["slug"])?$_POST["slug"]:"";

$notice_year = date("Y", strtotime($notice_date));
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from notice_colleges WHERE slug=:slug and id!=:id"
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
        $sql = "select * from notice_colleges WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $noticeRec = $stmt->fetch(PDO::FETCH_ASSOC);

        $page_link = $noticeRec['page_link'];

        if(isset($_FILES['page_link']['name']) && !empty($_FILES['page_link']['name'])){

            $errors = validateNoticePage($_FILES['page_link']);

            

            if (empty($errors)) {
                $ext = pathinfo($_FILES['page_link']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['page_link']['tmp_name'];
                //$notice_file_name = "notice-".$id.'.'.$ext;

                if($noticeRec && !empty($noticeRec['page_link']) && isset($noticeRec['page_link']) && $noticeRec['page_link'] !=''){

                    $upload_path = BASE_URL_UPLOADS."/notices/".$page_link;

                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    
                }

                $upload_path = '../../uploads/notices/';

                

                    $parentDirectory = '../../uploads/notices/college'; 
                   // $newDirectoryName = str_replace(' ', '_', strtolower(getCollegeNameById($college_id)." ".$college_id));
                    $newDirectoryName = $college_id.'/'.$notice_year;
                    
                    $fullPath = $parentDirectory . '/' . $newDirectoryName;
                    if (!is_dir($fullPath)) {
                        if (mkdir($fullPath, 0755, true)) {
                        } else {
                            
                            $statusarr["status"] = 0;
                            $statusarr["msg"] = "Failed to create directory.";
                            echo json_encode($statusarr);
                            return;
                        }
                    }
                    $notice_file_name =  "college/".$newDirectoryName.'/'.$record_id.'-notice.'.$ext;
                


                $newFilePath = $upload_path.$notice_file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                   $page_link = $notice_file_name;
                   $url_link ="";
                } 
            } else {

                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }

              
        }
        
       
        $sql = 
            "UPDATE notice_colleges SET course_for = :course_for, notice_category = :notice_category, notice_title = :notice_title, college_id = :college_id, notice_type = :notice_type,page_link = :page_link, url_link = :url_link,has_attachment = :has_attachment, notice_date = :notice_date,is_new = :is_new,is_active = :is_active, description = :description, tags = :tags,  notice_year = :notice_year, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":course_for", $course_for, PDO::PARAM_STR);
        $stmt->bindParam(":notice_category", $notice_category, PDO::PARAM_STR);
        $stmt->bindParam(":notice_title", $notice_title, PDO::PARAM_STR);       
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);
       
        $stmt->bindParam(":notice_type", $notice_type, PDO::PARAM_STR);  
        $stmt->bindParam(":page_link", $page_link, PDO::PARAM_STR);  
        $stmt->bindParam(":url_link", $url_link, PDO::PARAM_STR);  

        $stmt->bindParam(":has_attachment", $has_attachment, PDO::PARAM_INT);
        $stmt->bindParam(":notice_date", $notice_date, PDO::PARAM_STR);
        $stmt->bindParam(":is_new", $is_new, PDO::PARAM_INT);
        $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        $stmt->bindParam(":notice_year", $notice_year, PDO::PARAM_STR);
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
        "select * from notice_colleges WHERE slug=:slug "
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
        
        
        
       // $active_status = 1;
        $sql =
            "INSERT INTO notice_colleges (course_for,notice_category,notice_title,college_id,notice_type,url_link,has_attachment, notice_date,is_new, description, tags,notice_year,created_at, created_by, is_active) VALUES (:course_for,:notice_category, :notice_title, :college_id,:notice_type, :url_link,:has_attachment,:notice_date,:is_new, :description, :tags,:notice_year,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":course_for", $course_for, PDO::PARAM_STR);
        $stmt->bindParam(":notice_category", $notice_category, PDO::PARAM_STR);
        $stmt->bindParam(":notice_title", $notice_title, PDO::PARAM_STR);       
        $stmt->bindParam(":college_id", $college_id, PDO::PARAM_INT);       
        $stmt->bindParam(":notice_type", $notice_type, PDO::PARAM_STR); 
        $stmt->bindParam(":url_link", $url_link, PDO::PARAM_STR);
        $stmt->bindParam(":has_attachment", $has_attachment, PDO::PARAM_INT);
        $stmt->bindParam(":notice_date", $notice_date, PDO::PARAM_STR);
        $stmt->bindParam(":is_new", $is_new, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        $stmt->bindParam(":notice_year", $notice_year, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();


            if(isset($_FILES['page_link']['name']) && !empty($_FILES['page_link']['name'])){

                $errors = validateNoticePage($_FILES['page_link']);

                

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['page_link']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['page_link']['tmp_name'];
                    //$notice_file_name = "notice-".$id.'.'.$ext;


                    $upload_path = '../../uploads/notices/';
                        $parentDirectory = '../../uploads/notices/college'; // Specify the path to the parent folder
                        //$newDirectoryName = str_replace(' ', '_', strtolower(getCollegeNameById($college_id)." ".$college_id));
                         $newDirectoryName = $college_id.'/'.$notice_year; // Name of the new folder to be created
                        
                        $fullPath = $parentDirectory . '/' . $newDirectoryName;
                        
                        // Check if the directory already exists
                        if (!is_dir($fullPath)) {
                            // Attempt to create the directory
                            if (mkdir($fullPath, 0755, true)) {
                                //echo "Directory created successfully.";
                            } else {
                                
                                $statusarr["status"] = 0;
                                $statusarr["msg"] = "Failed to create directory.";
                                echo json_encode($statusarr);
                                return;
                            }
                        } 
                        $notice_file_name =  "college/".$newDirectoryName.'/'.$id.'-notice.'.$ext;

					$newFilePath = $upload_path.$notice_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $page_link = $notice_file_name;
                       $url_link ="";
                    } 
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }

                  
            }
            $slug = "notice/college/".$slug;
            $slug= $slug."-".$id;
            
            $sql = "UPDATE notice_colleges SET slug = :slug, page_link = :page_link, url_link = :url_link WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->bindParam(":page_link", $page_link, PDO::PARAM_STR);
            $stmt->bindParam(":url_link", $url_link, PDO::PARAM_STR);
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
