<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from page_universities WHERE id=:id";
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

    $sql = "UPDATE page_universities SET is_active = :is_active WHERE id = :id";
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
$page_title = sanitize_string($_POST["page_title"]);
$university_id = !empty($_POST["university_id"])?$_POST["university_id"]:0;

$html_page = "";
$description = sanitize_string($_POST["description"]);
$tags = sanitize_string($_POST["tags"]);
$slug = isset($_POST["slug"])?$_POST["slug"]:"";
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
    $existQuery = $dbConn->prepare(
        "select * from page_universities WHERE slug=:slug and id!=:id"
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
        $sql = "select * from page_universities WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $noticeRec = $stmt->fetch(PDO::FETCH_ASSOC);

        

        $html_page = $noticeRec['html_page'];
        if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){

            $errors = validateNoticePage($_FILES['html_page']);
            
            
            
            if (empty($errors)) {
                $ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['html_page']['tmp_name'];
                //$notice_file_name = "notice-".$id.'.'.$ext;
            
                if($noticeRec && !empty($noticeRec['html_page']) && isset($noticeRec['html_page']) && $noticeRec['html_page'] !=''){
            
                    $upload_path = BASE_URL_UPLOADS."/".$html_page;
            
                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    
                }
            
                $upload_path = '../../uploads/';
            
                
            
                $parentDirectory = '../../uploads/pages/university'; // Specify the path to the parent folder
                //$newDirectoryName = str_replace(' ', '_', strtolower(getUniversityNameById($university_id)." ".$university_id));
                $newDirectoryName = $university_id;
                
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
            
                                   
                //$upload_path = '../../uploads/notices/college/'.$college_name.'/';
                $notice_file_name =  "pages/university/".$newDirectoryName.'/'.$record_id.'-page.'.$ext;
                
            
            
                $newFilePath = $upload_path.$notice_file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                   $html_page = $notice_file_name;
                } 
            } else {
            
                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
              
            }
        
       
        $sql = 
            "UPDATE page_universities SET page_title = :page_title, university_id = :university_id , html_page = :html_page, description = :description, tags = :tags, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":page_title", $page_title, PDO::PARAM_STR);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
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
        "select * from page_universities WHERE slug=:slug "
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
        
        
        
        $is_active = 1;
        $sql =
            "INSERT INTO page_universities (page_title,university_id, description, tags, created_at, created_by, is_active) VALUES (:page_title,:university_id,:description, :tags,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":page_title", $page_title, PDO::PARAM_STR);
        $stmt->bindParam(":university_id", $university_id, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":tags", $tags, PDO::PARAM_STR);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

            if(isset($_FILES['html_page']['name']) && !empty($_FILES['html_page']['name'])){

                $errors = validateNoticePage($_FILES['html_page']);

                

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['html_page']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['html_page']['tmp_name'];
                    //$notice_file_name = "notice-".$id.'.'.$ext;


                        $upload_path = '../../uploads/';

                        //$university_name = getUniversityNameById($university_id);

                        $parentDirectory = '../../uploads/pages/university'; // Specify the path to the parent folder
                        //$newDirectoryName = str_replace(' ', '_', strtolower(getUniversityNameById($university_id)." ".$university_id));
                        $newDirectoryName = $university_id;
                        
                        $fullPath = $parentDirectory . '/' . $newDirectoryName;
                        
                        // Check if the directory already exists
                        if (!is_dir($fullPath)) {
                            // Attempt to create the directory
                            if (mkdir($fullPath, 0755, true)) {
                                //echo "Directory created successfully.";
                            }
                        } 
                        
                        // else {
                        //     $statusarr["status"] = 0;
                        //     $statusarr["msg"] = "Directory already exists.";
                        //     echo json_encode($statusarr);
                        //     return;
                        // }

                                           
                        //$upload_path = '../../uploads/notices/college/'.$college_name.'/';
                        $notice_file_name =  "pages/university/".$newDirectoryName.'/'.$id.'-page.'.$ext;

					$newFilePath = $upload_path.$notice_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $html_page = $notice_file_name;
                    } 
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }

                  
            }

            $slug = "pages/university/".$slug;
            $slug= $slug."-".$id;
          

           
            
            $sql = "UPDATE page_universities SET slug = :slug, html_page = :html_page WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->bindParam(":html_page", $html_page, PDO::PARAM_STR);
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
