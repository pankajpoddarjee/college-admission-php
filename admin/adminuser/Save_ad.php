<?php
include_once "../session.php";
include_once "../connection.php";
include_once "../configuration.php";
include_once "../function.php";



if (isset($_GET["eid"])) {
    $record_id = $_GET["eid"];

    $sql = "select * from ads WHERE id=:id";
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

    $sql = "UPDATE ads SET is_active = :is_active WHERE id = :id";
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
$client_id = sanitize_string($_POST["client_id"]);
$ad_link = sanitize_string($_POST["ad_link"]);
$alt = sanitize_string($_POST["alt"]);
$ad_image = "";
$created_at = date("Y-m-d H:i:s");
$created_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
$updated_at = date("Y-m-d H:i:s");
$updated_by = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";



//print_r($_FILES);

if ($action == "edit" && !empty($record_id) && isset($record_id)) {
   
        $sql = "select * from ads WHERE id=:id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":id", $record_id, PDO::PARAM_INT);
        $stmt->execute();

        $adRec = $stmt->fetch(PDO::FETCH_ASSOC);

        

        $ad_image = $adRec['ad_image'];
        if(isset($_FILES['ad_image']['name']) && !empty($_FILES['ad_image']['name'])){

            $errors = validateAdImage($_FILES['ad_image']);
            
            
            
            if (empty($errors)) {
                $ext = pathinfo($_FILES['ad_image']['name'], PATHINFO_EXTENSION);
                //$uniqueSlug = generateSlug($college_name);
                $tmpFilePath = $_FILES['ad_image']['tmp_name'];
                //$notice_file_name = "notice-".$id.'.'.$ext;
            
                if($adRec && !empty($adRec['ad_image']) && isset($adRec['ad_image']) && $adRec['ad_image'] !=''){
            
                    $upload_path = BASE_URL_UPLOADS."/ad/".$ad_image;
            
                    if (file_exists($upload_path)) {
                        unlink($upload_path);
                    }
                    
                }
            
                $upload_path = '../../uploads/ad/';    
              
                $ad_file_name =  $record_id.'-ad.'.$ext;
            
                $newFilePath = $upload_path.$ad_file_name;
                if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                   $ad_image = $ad_file_name;
                } 
            } else {
            
                $statusarr["status"] = 0;
                $statusarr["msg"] = implode($errors);
                echo json_encode($statusarr);
                return;
            }
            
              
            }
        
       
        $sql = 
            "UPDATE ads SET client_id = :client_id,ad_link = :ad_link, alt = :alt , ad_image = :ad_image, updated_at = :updated_at,updated_by = :updated_by WHERE id = :id";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
        $stmt->bindParam(":ad_link", $ad_link, PDO::PARAM_STR);
        $stmt->bindParam(":alt", $alt, PDO::PARAM_INT);
        $stmt->bindParam(":ad_image", $ad_image, PDO::PARAM_STR);
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
    
    $dbConn= NULL;
} else {
        
        $is_active = 1;
        $sql =
            "INSERT INTO ads (client_id, ad_link,alt, created_at, created_by, is_active) VALUES (:client_id,:ad_link,:alt,:created_at,:created_by, :is_active)";
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":client_id", $client_id, PDO::PARAM_INT);
        $stmt->bindParam(":ad_link", $ad_link, PDO::PARAM_STR);
        $stmt->bindParam(":alt", $alt, PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":is_active", $is_active, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
            $id = $dbConn->lastInsertId();

            if(isset($_FILES['ad_image']['name']) && !empty($_FILES['ad_image']['name'])){

                $errors = validateAdImage($_FILES['ad_image']);

                

                if (empty($errors)) {
                    $ext = pathinfo($_FILES['ad_image']['name'], PATHINFO_EXTENSION);
					//$uniqueSlug = generateSlug($college_name);
                    $tmpFilePath = $_FILES['ad_image']['tmp_name'];
                    //$notice_file_name = "notice-".$id.'.'.$ext;


                        $upload_path = '../../uploads/ad/';
                                           
                        //$upload_path = '../../uploads/notices/college/'.$college_name.'/';
                        $ad_file_name =  $id.'-ad.'.$ext;

					$newFilePath = $upload_path.$ad_file_name;
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                       $ad_image = $ad_file_name;
                    } 
                } else {
                    $statusarr["status"] = 0;
                    $statusarr["msg"] = implode($errors);
                    echo json_encode($statusarr);
                    return;
                }

                  
            }

           
            
            $sql = "UPDATE ads SET  ad_image = :ad_image WHERE id = :id";           
            $stmt = $dbConn->prepare($sql);
            $stmt->bindParam(":ad_image", $ad_image, PDO::PARAM_STR);
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
    
    $dbConn= NULL;
}




?>
